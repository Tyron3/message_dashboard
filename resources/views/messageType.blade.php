@extends('layouts.main')
@section('content')
<br/>
<div class="container">
    <p class="h4 mb-4">Most Active Message Type</p>

    <table class="table-auto">
        <thead>
            <tr>
            <th class="px-4 py-2">Message Type</th>
            <th class="px-4 py-2">Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                <td class="border px-4 py-2">{{ $message->message_type }}</td>
                <td class="border px-4 py-2">{{ $message->message }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>

</div>
<br/>
@endsection

