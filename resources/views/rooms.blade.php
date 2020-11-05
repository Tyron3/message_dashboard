@extends('layouts.main')
@section('content')
<br/>
<div class="container">
    <p class="h4 mb-4">Most Active Rooms Per Client</p>

    <table class="table-auto">
        <thead>
            <tr>
            <th class="px-4 py-2">Client</th>
            <th class="px-4 py-2">Month</th>
            <th class="px-4 py-2">Room</th>
            <th class="px-4 py-2">Message Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                <td class="border px-4 py-2">{{ $message->client }}</td>
                <td class="border px-4 py-2">{{ $message->month }}</td>
                <td class="border px-4 py-2">{{ $message->room }}</td>
                <td class="border px-4 py-2">{{ $message->messages }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
</div>
<br/>
@endsection

