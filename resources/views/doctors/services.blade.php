@extends('layouts.app')
@section('content')

<div>
    services
</div>

<div>
    <table class="table"  >
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            {{-- <th scope="col">title</th> --}}
            {{-- <th scope="col">operations</th> --}}
          </tr>
        </thead>
        <tbody>

            @if (isset($services)&& $services->count()>0)
            @foreach ($services as $service)

          <tr>
            <th scope="row">{{$service->id}}</th>
            <td>{{$service->name}}</td>
            {{-- <td>{{$doctor->title}}</td>
            <td><a href="{{route('doctors.services',$doctor->id)}}" class="btn btn-success">servicess of the doctor</a></td> --}}
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>

      <br><br>
      <form method="post" id="" action="{{route('save.doctors.services')}}" style="padding:3%">
        @csrf
        {{-- @method('PUT') --}}



        {{-- <input name="_token" value="{{csrf_token()}}" > --}}
        <div class="form-group">
            <label for="exampleInputEmail1">choose a doctor</label>
            {{-- <input type="text" class="form-control" name="name" placeholder="choose a doctor"> --}}

                <select class="form-control" name="doctor_id" >
                    @foreach ($doctors as $doctor  )
                    <option value="{{$doctor->id}}">

                        {{$doctor->name}}
                    </option>
                    @endforeach
                </select>

        </div>

        <div class="form-group" >
            <label for="exampleInputEmail1">choose a service</label>
            {{-- <input type="text" class="form-control" name="name" placeholder="Enter email"> --}}

                <select class="form-control" name="servicesIds[]" multiple>
                    @foreach ($allServices as $allService  )
                    <option value="{{$allService->id}}">

                        {{$allService->name}}
                    </option>
                    @endforeach
                </select>

        </div>



        <button id="save_offer" class="btn btn-primary">Save Offer</button>
    </form>

</div>

@stop
