<x-mail::message>
    # You've been invited!

    **{{ $inviterName }}** has invited you to join their colocation **"{{ $colocationName }}"** on EasyColoc.

    Click the button below to view and accept your invitation. You will need to click 'Accept' to join.

    <x-mail::button :url="$url">
        View Invitation
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>