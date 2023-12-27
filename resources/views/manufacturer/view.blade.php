@extends('layouts.app')
@section('title','Manufacturers')

@section('content')

<div class="container">

  <h2>Manufacturer Details:</h2>
  <br />
  
    <div class="form-group">
      <label for="title">Title:</label>
      <input disabled type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ $title }}">
    </div>
    <div class="form-group">
      <label for="desc">Description:</label>
      <textarea disabled class="form-control" id="desc" name="description" rows="4" cols="50">{{ $description }}</textarea>
    </div>

</div>

@endsection