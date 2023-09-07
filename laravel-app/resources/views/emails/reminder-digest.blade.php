<x-mail::message>
# Introduction

The following task is expired:

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->
<x-mail::table>

   <p> Title: {{ $reminders['title'] }} </p> 
    <p> Description: {{ $reminders['description'] }} </p> 
    <p>Start Date: {{ date("m/dY",strtotime($reminders['start_date'])) }} </p>
    <p>End Date: {{ date("m/dY",strtotime($reminders['end_date'])) }} </p>

</x-mail::table>0
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
