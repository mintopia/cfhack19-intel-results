@extends('application.layout')
@section('content')
    <div class="text-center">
        <h1 class="mt-1 mb-5">{{ $result->getEmotion() }}</h1>
        <img src="{{ $result->image_url }}" class="rounded-sm ml-image"/>
    </div>


    <h3 class="mt-5">Data</h3>

    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Emotion</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href="{{ route('results.show', $result->uuid) }}">
                        {{ $result->uuid }}
                    </a>
                </td>
                <td>{{ $result->getEmotion() }}</td>
                <td>{{ $result->created_at->format('Y-M-d H:i:s') }}</td>
            </tr>
        </tbody>
    </table>
@endsection
