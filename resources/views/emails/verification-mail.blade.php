<x-mail::message>
# Welcome

Click on the button below to verify your email

<x-mail::button :url="$url">
verify
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
