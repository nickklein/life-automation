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
        <label for="name">Name</label>
        <input type="text" class="form-control" name="item_name" id="name" aria-describedby="name" value="{{ $item['name'] }}">
        @if ($errors->has('item_name'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_name') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group">
        <label for="name">URL</label>
        <input type="text" class="form-control" name="item_url" id="url" aria-describedby="url" value="{{ $item['url'] }}">
        @if ($errors->has('item_url'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_url') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group">
        <label for="name">Amount</label>
        <input type="text" class="form-control" name="item_amount" id="amount" aria-describedby="amount" value="{{ $item['amount'] }}">
        @if ($errors->has('item_amount'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_amount') }}</strong>
          </span>
        @endif
    </div>


      <div class="form-group">
        <label for="name">Grams</label>
        <input type="text" class="form-control" name="item_grams" id="grams" aria-describedby="grams" value="{{ $item['grams'] }}">
        @if ($errors->has('item_grams'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_grams') }}</strong>
          </span>
        @endif
      </div>

    <div class="form-group">
        <label for="name">Price</label>
        <input type="text" class="form-control" name="item_price" id="price" aria-describedby="price" value="{{ $item['price'] }}">
        @if ($errors->has('item_price'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('item_price') }}</strong>
          </span>
        @endif
    </div>


      <div class="form-group">
          <label for="name">ml</label>
          <input type="text" class="form-control" name="item_ml" id="ml" aria-describedby="ml" value="{{ $item['ml'] }}">
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
