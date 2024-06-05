@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>offers</title>
</head>
<body>
    <div>
        <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    </div>

    <div class="alert alert-success" id="success_msg" style="display: none">
        deleted successfully
    </div>

    {{-- @if (Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>

    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('errror')}}
    </div>

    @endif --}}
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">offer name</th>
            <th scope="col">offer price</th>
            <th scope="col">offer details</th>
            <th scope="col">offer operation</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($offers as $offer)
            <tr class="offerRow{{$offer->id}}">
                <th scope="row">{{$offer->id}}</th>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->details}}</td>
                <td><img src="{{asset('images/offers/'.$offer->photo)}}"/></td>

                <td>
                    <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success">editing</a>
                    <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger">delete</a>

                    <a href="" offer_id="{{$offer->id}}" class="delete_btn btn btn-danger">delete ajax</a>
                    <a href="{{route('ajax.offers.edit',$offer->id)}}" class="btn btn-success">editing1</a>
                </td>
              </tr>
            @endforeach


</body>
</html>



@section('scripts')
    <script>
        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();

            var offer_id=$(this).attr('offer_id');

            //var formData=new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                //enctype:'multipart/form-data',
                url: "{{ route('ajax.offers.delete') }}",
                data:{

                    '_token': "{{ csrf_token() }}",
                    'id':offer_id,

                },
                // processData:false,
                // contentType:false,
                // cache:false,
                    //'':2,


                    //'photo'=>$("input[name='photo']").val(),
                    // 'name' => $("input[name='name']").val(),
                    // 'price' => $("input[name='price']").val(),
                    // 'details' => $("input[name='details']").val(),

                success: function(data) {
                    if(data.status==true){
                    $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();
                    //alert(data.msg)
                },
                error: function(reject) {}
            });
        });
    </script>
@stop
