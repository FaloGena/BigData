@extends('master')

@section('content')
    <div id="wrap">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Method</th>
                        <th scope="col">Path</th>
                        <th scope="col">Status</th>
                        <th scope="col">Execution time (ms)</th>
                        <th scope="col">Started at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($savedRequests as $request)
                        <tr>
                            <th scope="row">{{ $request->type }}</th>
                            <td>{{ $request->uri }}</td>
                            <td>{{ $request->status }}</td>
                            <td>{{ $request->time }}</td>
                            <td>{{ $request->created_at->diffForHumans(now()) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            <div class="" style="float: right;">
                <a class="btn btn-info" role="button" href="{{ route('index') }}">Back to main</a>
            </div>
        </div>

        {{ $savedRequests->links() }}
    </div>
@endsection
