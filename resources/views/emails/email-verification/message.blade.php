@component('mail::message')
Hi {{$name}}!

Thanks so much for joining our Blog! To finish your Registration,  you just need to confirm that we got your email right.

@component('mail::button', ['url' => $mail_url])
  Confirm  Your E-Mail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
