<x-mail::message>
# Introduction

The following task is expired:

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->
<x-mail::table>
 @foreach($reminders as $reminder)
    {{ $reminder['title'] }} | {{ $reminder['description'] }} | {{ date("m/dY",strtotime($reminder['start_date'])) }} | {{ date("m/dY",strtotime($reminder['end_date'])) }} 
 @endforeach
</x-mail::table>0
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
