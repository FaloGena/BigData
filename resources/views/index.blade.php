@extends('master')

@section('content')
    <div id="wrap">
        <div class="container">
            <div class="row">
                @foreach($types as $type)
                    @component('components.form')
                        @slot('type', $type)
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
@endsection
