@extends('application.layout')
@section('content')
    <h1>Historical Data</h1>

    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Emotion</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>
                        <a href="{{ route('results.show', $result->uuid) }}">
                            {{ $result->uuid }}
                        </a>
                    </td>
                    <td>{{ $result->getEmotion() }}</td>
                    <td>{{ $result->created_at->format('Y-M-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $results !!}
@endsection
