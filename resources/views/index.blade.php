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
                   console.log(response);
               })
               .fail(function (response) {
                    console.log(response);
               });

           })
        });
    </script>
@endpush
