@component('mail::message')
# Employee Manager System

<p>Welcome,</p>
<p>You have requested to reset your account password.</p>
<b>Your username:</b> {{ $username }} <br>
<b>New password:</b> {{ $password }}
<p>Please change your password after login successfully.</p>
@component('mail::button', ['url' => config('app.url') . '/login'])
Login Now
@endcomponent
Thanks,<br>
### Employee Manager System Team
@endcomponent
