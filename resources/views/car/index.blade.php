@extends('layouts.app')
@section('title','Cars list')

@section('content')

<div class="container">

  <h2>All cars list</h2>
  <a href="{{ url('car/create') }}">
    <button type="button" class="btn btn-outline-primary">Add new</button>
  </a>

  <br />
  <br />
  
  @foreach($cars as $car)
    <div class="panel-group">
        <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse{{$car->id}}">{{$car->title}}</a>
                <span style="margin-left:20px;">
                  <a href="{{ url('manufacturer/'.$car->manufacturer->id) }}"><button type="button" class="btn btn-outline-primary">Manufacturer</button></a>
                </span>
                  <a href="{{ url('car/'.$car->id) }}"><button type="button" class="btn btn-outline-primary">View</button></a>
                </span>
                <span>
                    <a href="{{ url('car/'.$car->id.'/edit') }}"><button type="button" class="btn btn-outline-primary">Edit</button></a>
                </span>
                <span>
                    <button type="button" class="btn btn-outline-danger delete-btn" data-toggle-="modal" data-target-="#myModal" data-id="{{$car->id}}">Delete</button>
                </span>
            </h4>
        </div>
        <div id="collapse{{$car->id}}" class="panel-collapse collapse">
            <div class="panel-body">{{$car->description}}</div>
            <!--- <div class="panel-footer">Panel Footer</div> --->
        </div>
        </div>
    </div>
  @endforeach

</div>

<!-- Modal for deleting resource confirmations -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please confirm</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this?</p>
      </div>
      <div class="modal-footer">
        <form id="delete-form" action="{{ route('car.destroy', '1') }}" method="POST">
            @method('DELETE') @csrf
            <input id="input-url" hidden="text" value="{{ route('car.destroy','') }}">
        </form>
        <button type="button" id="delete-confirm" class="btn btn-outline-danger">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection