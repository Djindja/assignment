@extends("admin.includes.master")

@section('title', Lang::get('titles.trip.title'))

@section('content')

<div class="col-xs-12">
  <div class="x_panel">
    <button style="float: right;" class="btn btn-primary btn-lg" onClick="window.open('{{url("trip/create")}}', '_self');">+ {{Lang::get('titles.add')}}</button>
    <div class="x_title">
      <h2 style="float: left; width: 100%;">{{Lang::get('titles.trip.list')}}</h2>
      </br>
    </div>
    <div class="x_content">

      <table class="table">
        <thead>
          <tr>
            <th style="text-align: left; width: 5%;">#</th>
            <th style="text-align: left; width: 20%;">{{Lang::get('titles.trip.name')}}</th>
            <th style="text-align: center; width: 5%;">{{Lang::get('titles.edit')}}</th>
            <th style="text-align: center; width: 5%;">{{Lang::get('titles.delete')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($trips as $index => $trip)
          <tr>
            <td style="text-align: left; width: 5%;" scope="row">{{$index+1}}</td>
            <td style="text-align: left; width: 20%;">{{$trip->name}}</td>
            <td style="text-align: center; width: 5%;"><a href="{{url("trip/edit/$trip->id")}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
            <td style="text-align: center; width: 5%;"><a onclick="return (confirm('Are you sure?'))" href="{{url("trips/delete/$trip->id")}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection