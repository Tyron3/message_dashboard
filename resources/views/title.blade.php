@extends('layouts.main')
@section('content')
<br/>
<div class="container">
    <p class="h4 mb-4">Most Active Clients</p>

    <table class="table-auto">
    <thead>
            <tr>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Environment</th>
            <th class="px-4 py-2">Messages</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                <td class="border px-4 py-2">{{ $message->title }}</td>
                <td class="border px-4 py-2">{{ $message->environment }}</td>
                <td class="border px-4 py-2">{{ $message->messages }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
</div>
<br/>
@endsection

