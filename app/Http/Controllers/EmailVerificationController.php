<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailVerificationRequest;
use App\Http\Requests\UpdateEmailVerificationRequest;
use App\Mail\EmailVerificationMail;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailVerificationController extends Controller
{
    public function token()
    {
        return Str::random(64);
    }

    public function expire($minutes = 15)
    {
        return now()->addMinutes($minutes);
    }

    public function store(StoreEmailVerificationRequest $request)
    {
        try {
            $token = $this->token();
            $expire = $this->expire();
            $email = $request->validated('email');

            $values = [
                'email' => $email, 
                'token' => $token, 
                'expire' => $expire
            ];

            if (EmailVerification::where('email', $email)->exists()) {
                $this->update($email);
                return back()->with('success', 'A verification link has been sent to your email');
            }

            if (!EmailVerification::create($values)) {
                return back()->with('error', 'something went wrong');
            }
            $this->sendVerificationEmail($email, $token);

            return back()->with('success', 'A verification link has been sent to your email');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'something went wrong');
        }
    }

    public function update($email)
    {
        $token = $this->token();
        $expire = $this->expire();
        EmailVerification::where('email', $email)->update([
            'token' => $token,
            'expire' => $expire
        ]);
        $this->sendVerificationEmail($email, $token);
    }

    public function destroy($email)
    {
        EmailVerification::where('email', $email)->delete();
    }

    public function sendVerificationEmail($email, $token)
    {
        Mail::to($email)->send(new EmailVerificationMail($token));
    }

    public function verify($token)
    {
        $emailVerification = EmailVerification::where('token', $token);
        if (!$emailVerification->exists()) {
            return redirect()->route('auth.register-email-page')->with('error', 'Invalid Verification Address');
        }

        $data = $emailVerification->first();
        if ($data->expire < now()) {
            $this->update($data->email);
            return redirect()->route('auth.register-email-page')->with('error', 'verification link has expired, a fresh one has been resent to your email');
        }

        AuthController::store($data->email);
        $this->destroy($data->email);

        return redirect()->route('auth.register-page', $data->email)->with('success', 'Email Verified, Continue registration');
    }
}
