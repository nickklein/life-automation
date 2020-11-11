@extends('layouts.app')

@section('content')
<h3>Update Categories</h3>

<p><a href="{{ route('shopping.categories.show', $data['sh_categories_user_id']) }}">Back to {{ $data['name'] }}</a></p>

@if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif

<form method="POST" action="{{ route('shopping.categories.update') }}">
    @csrf

    <input type="hidden" name="category_id" value="{{ $data["sh_category_id"] }}">

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="category_name" id="name" aria-describedby="name" value="{{ $data["name"] }}">

        @if ($errors->has('category_name'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('category_name') }}</strong>
          </span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection
