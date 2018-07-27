@extends("admin.includes.master")

@section('title', Lang::get('titles.trip.create'))

@section('content')

<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{url("/trip/create")}}">
  {{csrf_field()}}

 <div class="x_content">
     <h2>{{Lang::get('titles.trip.create')}}</h2>
 </br>
 
  <div class="form-group">
    <label class="col-md-2">{{Lang::get('titles.trip.import')}}<span class="required"> *</span>
    </label>
    <div class="col-md-4">
      <input type="file" name="gpx" accept=".gpx" class="form-control form-group" required="required"/>
    </div>
  </div>
  
  </br>

  <div class="col-md-2">
      <button type="submit" class="btn btn-primary btn-md">{{Lang::get('titles.submit')}}</button>
  </div>
 </div>
</form>

@endsection