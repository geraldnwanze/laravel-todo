<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $tasks;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $tasks)
    {
        $this->name = $name;
        $this->tasks = $tasks;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tasks For Today '. today()->format('Y-m-d'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.task-mail',
            with: ['name' => $this->name, 'tasks' => $this->tasks]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
