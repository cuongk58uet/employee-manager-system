@component('mail::message')
# Employee Manager System

<p>Welcome to Employee Manager System,</p>
<p>You have successfully registered your account on our system.</p>
<b>Your Username:</b> {{ $username }} <br>
<b>Your password:</b> {{ $password }}
<p>Please change your password after login successfully.</p>
@component('mail::button', ['url' => config('app.url') . '/login'])
Login Now
@endcomponent
Thanks,<br>
### Employee Manager System Team
@endcomponent
