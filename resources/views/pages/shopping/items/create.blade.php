@extends('layouts.app')

@section('content')
<h3>Create Items</h3>

<p><a href="{{ route('shopping.categories') }}">Back to homepage</a></p>

@if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif

<form method="POST" action="{{ route('shopping.items.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Item Name</label>
        <input type="text" class="form-control" name="item_name" id="name" aria-describedby="name">
        @if ($errors->has('item_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('item_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="name">Item URL</label>
        <input type="text" class="form-control" name="item_url" id="url" aria-describedby="name">
        @if ($errors->has('item_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('item_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="name">Category</label>
        <select name="category">
            @foreach ($categories as $category)
                <option value="{{ $category['sh_category_id'] }}">{{ $category['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Store</label>
        <select name="store">
            @foreach ($stores as $store)
                <option value="{{ $store['store_id'] }}">{{ $store['name'] }}</option>
            @endforeach
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
