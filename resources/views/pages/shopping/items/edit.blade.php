@extends('layouts.app')

@section('content')
<h3>Edit Item</h3>

<p><a href="{{ route('shopping.items') }}">Back to homepage</a></p>

@if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif

<form method="POST" action="{{ route('shopping.items.update') }}">
    @csrf
        <input type="hidden" name="item_id" value="{{ $item['sh_item_id'] }}">
        <div class="form-group">
        <label for="name">Item Name</label>
        <input type="text" class="form-control" name="item_name" id="name" aria-describedby="name" value="{{ $item['name'] }}">
        @if ($errors->has('item_name'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_name') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group">
        <label for="name">Item URL</label>
        <input type="text" class="form-control" name="item_url" id="url" aria-describedby="name" value="{{ $item['url'] }}">
        @if ($errors->has('item_url'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_url') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group">
        <label for="name">Category</label>
        <select name="category">
            @foreach ($categories as $category)
                <option value="{{ $category['sh_category_id'] }}"  {{ $item['category_id'] === $category['sh_category_id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="name">Store</label>
        <select name="store">
            @foreach ($stores as $store)
                <option value="{{ $store['store_id'] }}" {{ $item['store_id'] === $store['store_id'] ? 'selected' : '' }}>{{ $store['name'] }}</option>
            @endforeach
        </select>
      </div>


      <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
