@extends('layouts.app')
@section('title','Car')

@section('content')

<div class="container">

  <h2>Car Form</h2>
  <br />
  
  <form action="{{ (isset($edit) && $edit) ? url('/car/'.$edit_id) : url('/car') }}" method="POST">
    @csrf
    @if( isset($edit) && $edit)
        @method('PUT')
    @endif

    <div class="form-group">
      <label for="manufacturer" class="form-label">Manufacturer:</label>
      <select name="manufacturers_id" id="manufacturer" class="form-select">
       <option value="">Select an option</option>
        @foreach($manufacturers as $manufacturer)
          <option value="{{$manufacturer->id}}" {{ $manufacturers_id == $manufacturer->id ? 'selected' : '' }}>{{$manufacturer->title}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ $title }}">
    </div>
    <div class="form-group">
      <label for="desc">Description:</label>
      <textarea class="form-control" id="desc" name="description" rows="4" cols="50">{{ $description }}</textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

  @if( $errors->any() )
    <br />
        @foreach( $errors->all() as $error)
            <div style="color:red;">{{ $error }}</div>
        @endforeach
  @endif

</div>

@endsection