@extends('layouts.app')
@section('content')

<div>
    doctors
</div>

<div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">title</th>
            <th scope="col">operations</th>
          </tr>
        </thead>
        <tbody>

            @if (isset($doctors)&& $doctors->count()>0)
            @foreach ($doctors as $doctor)

          <tr>
            <th scope="row">{{$doctor->id}}</th>
            <td>{{$doctor->name}}</td>
            <td>{{$doctor->title}}</td>
            <td><a href="{{route('doctors.services',$doctor->id)}}" class="btn btn-success">servicess of the doctor</a></td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>

</div>

@stop
