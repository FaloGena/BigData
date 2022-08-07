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

            <div class="" style="float: right;">
                <a class="btn btn-info" role="button" href="{{ route('requests_info') }}">Check requests</a>
                <a class="btn btn-danger" role="button" href="{{ route('clear_table') }}">Clear DataBase table</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(() => {
           $('form.ajax').on('submit', function (e) {
                e.preventDefault();

                let form = $(this);
                let path = form.attr('action');
                let method = form.attr('method');

               $.ajax({
                   type: method,
                   url: path,
                   data: new FormData(this),
                   processData: false,
                   contentType: false,
               })
               .done(function (response) {
                   alert('done');
                   console.log(response);
               })
               .fail(function (response) {
                    console.log(response);
                   var errorJSON = JSON.parse(response.responseText);
                   var errorString = '';
                   $.each( errorJSON.errors, function( key, value) {
                       errorString += value + '\n\n';
                   });

                    alert(errorString);
               });

           })
        });
    </script>
@endpush
