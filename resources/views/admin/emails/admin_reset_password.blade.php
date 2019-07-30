@component('mail::message')
# Reset Account
Welcome {{ $data['data']->name }} <br>
The body of your message.

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
Click here to reset your password
@endcomponent
OR <br>
copy this link
<a href="{{ aurl('reset/password/'.$data['token']) }}">{{ aurl('reset/password/'.$data['token']) }}</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
