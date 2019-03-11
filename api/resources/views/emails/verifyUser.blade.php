@component('mail::message')
# Please verify your email address
***

Hi {{ $user['full_name'] }},

Please verify you email address so we know it's really you!

@component('mail::button', ['url' => env('FRONTEND_BASEURL').$user->verifyUser->token])
    Verify my email address
@endcomponent

Warm Regards,<br>
{{ config('app.name') }}
@endcomponent