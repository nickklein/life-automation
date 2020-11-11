@extends('layouts.app')

@section('content')
<h3>Create Categories</h3>

<p><a href="{{ route('shopping.categories') }}">Back to homepage</a></p>

@if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif

<form method="POST" action="{{ route('shopping.categories.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="category_name" id="name" aria-describedby="name">
        @if ($errors->has('category_name'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('category_name') }}</strong>
          </span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
