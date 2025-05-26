@component('mail::message')
    # Welcome to UAP, {{ $user->first_name }}!

    Your membership application has been approved.

    **Email:** {{ $user->email }}
    **Password:** {{ $password }}

    @component('mail::button', ['url' => route('login')])
        Login Now
    @endcomponent

    Please change your password after first login.

    Thanks,
    {{ config('app.name') }}
@endcomponent
