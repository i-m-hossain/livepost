<x-mail::message>
# Welcome {{$name}}
{{$message}}

<x-mail::panel>
    Keep an eye on upcoming Eid.
</x-mail::panel>

<x-mail::table>
| Serial       | Task Name         | Status       |
| -------------| :-----------:     | ------------: |
|   01          | Task1      | wip           |
|   02      | Task 2 |    done        |
</x-mail::table>

<x-mail::button :url="$url" color="success">
Visit our website
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}

</x-mail::message>