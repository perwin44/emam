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
    @if (Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>

    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('errror')}}
    </div>

    @endif
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
            <tr>
                <th scope="row">{{$offer->id}}</th>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->details}}</td>
                <td>
                    <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success">editing</a>
                    <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger">delete</a>
                </td>
              </tr>
            @endforeach
            </tbody>
        </table>
<div class="d-flex justify-content-center" style="width: 100px">
        {!! $offers->links()  !!}
</div>
</body>
</html>
