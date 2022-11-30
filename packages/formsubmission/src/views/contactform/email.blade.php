@component('mail::message')

    Message is

    {{$message}}
    @component('mail::button', ['url' => ''])
        Click
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}

@endcomponent
