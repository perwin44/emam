@extends('layouts.app')

@section('content')
<div>
<div>
    hospitals
</div>

<div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">address</th>
            <th scope="col">procedures</th>
          </tr>
        </thead>
        <tbody>

            @if (isset($hospitals)&& $hospitals->count()>0)
            @foreach ($hospitals as $hospital )
            <tr>
            <th scope="row">{{$hospital->id}}</th>
            <td>{{$hospital->name}}</td>
            <td>{{$hospital->address}}</td>
            <td>
                <a href="{{route('hospital.doctors',$hospital->id)}}" class="btn btn-success">doctors</a>
                <a href="{{route('hospital.delete',$hospital->id)}}" class="btn btn-danger">delete</a>
            </td>
          </tr>

          @endforeach
            @endif


        </tbody>
      </table>

</div>
</div>
@stop
