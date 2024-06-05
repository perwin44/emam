@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none">
            saved successfully
        </div>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Laravel</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        </head>

        <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}
                                    <span class="sr-only">(current)</span></a>
                            </li>
                        @endforeach





                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>

            <div>
                <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
                {{ __('Add your offer') }}
                {{-- Add your offer --}}
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <br>
            <form method="post" id="offerForm" action="{{ route('ajax.offers.store') }}" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') --}}

                <div class="form-group">
                    <label for="exampleInputPassword1">choose a picture</label>
                    <input type="file" class="form-control" name="photo">

                        <small id="photo_error" class="form-text text-danger">insert photo</small>

                </div>

                {{-- <input name="_token" value="{{csrf_token()}}" > --}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Offer Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter email">

                        <small id="name_error" class="form-text text-danger">insert name</small>

                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Offer Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Price">

                        <small id="price_error" class="form-text text-danger">insert price</small>

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Offer Details</label>
                    <input type="text" class="form-control" name="details" placeholder="details">

                        <small id="details_error" class="form-text text-danger">insert details</small>

                </div>
                {{-- <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
                <button id="save_offer" class="btn btn-primary">Save Offer</button>
            </form>



        </body>

        </html>
    </div>
@stop


@section('scripts')
    <script>
        $('#offerForm').on('click', '#save-offer', function(e) {
            e.preventDefault();

            $('#photo_error').text('');
            $('#name_error').text('');
            $('#price_error').text('');
            $('#details_error').text('');

            var formData=$this.serialize();

            $.ajax({
                type: 'post',
                enctype:'multipart/form-data',
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                    //'':2,
                    '_token': "{{ csrf_token() }}",

                    //'photo'=>$("input[name='photo']").val(),
                    // 'name' => $("input[name='name']").val(),
                    // 'price' => $("input[name='price']").val(),
                    // 'details' => $("input[name='details']").val(),

                success: function(data) {
                    if(data.status==true){
                    $('#success_msg').show();
                    }
                    //alert(data.msg)
                },
                error: function(reject) {
                    var response=$.parseJASON(reject.responseText);
                    $.each(response.errors,function(key,val){
                        $("#"+key+"error").text(val[0]);
                    });
                }
            });
        });
    </script>
@stop
