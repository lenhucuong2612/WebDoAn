@component('mail::message')
Hello <b>{{ $user->name }}</b>,

<p>You are almost ready to stary enjoying the benefits of E-commerce.</p>

<p>Simply click the button below to verify your email address.</p>
<p>@component('mail::button', ['url' => url("active/".base64_encode($user->id))])
    Verify
@endcomponent</p>

<p>This will verify your email address, and then you'll officially be a part of the E-Commerce</p>

@endcomponent