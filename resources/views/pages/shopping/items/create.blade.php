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
        <label for="name">Name</label>
        <input type="text" class="form-control" name="item_name" id="name" aria-describedby="name">
        @if ($errors->has('item_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('item_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="name">URL</label>
        <input type="text" class="form-control" name="item_url" id="url" aria-describedby="url">
        @if ($errors->has('item_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('item_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
      <label for="name">Amount</label>
      <input type="text" class="form-control" name="item_amount" id="amount" value="0" aria-describedby="amount">
      @if ($errors->has('item_amount'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('item_amount') }}</strong>
        </span>
      @endif
    </div>


    <div class="form-group">
        <label for="name">Grams</label>
        <input type="text" class="form-control" name="item_grams" id="grams" value="0" aria-describedby="grams">
        @if ($errors->has('item_grams'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_grams') }}</strong>
          </span>
        @endif
    </div>

    <div class="form-group">
        <label for="name">Price</label>
        <input type="text" class="form-control" name="item_price" id="price" value="0" aria-describedby="price">
        @if ($errors->has('item_price'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_price') }}</strong>
          </span>
        @endif
    </div>

    <div class="form-group">
        <label for="name">ml</label>
        <input type="text" class="form-control" name="item_ml" id="ml" value="0" aria-describedby="ml">
        @if ($errors->has('item_ml'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_ml') }}</strong>
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
