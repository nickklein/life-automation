@extends('layouts.app')

@section('content')
<h3>{{ $data["name"] }}</h3>

<p><a href="{{ route('shopping.categories') }}">Back to homepage</a></p>
<p><a href="{{ route('shopping.categories.edit', $data['sh_categories_user_id']) }}" class="btn btn-primary">Edit Category</a></p>

<div class="table-responsive-md">
    <table class="table">
        <thead class="thead">
            <th>Name</th>
            <th>Price</th>
            <th>Info</th>
            <th>Store</th>
        </thead>

        <tbody>
            @foreach ($data['items'] as $item)
                <tr>
                    <td><a href="{{route('shopping.items.edit', ['itemId' => $item['sh_item_id']])}}">{{ $item['name'] }}</a></td>
                    <td>{{ $item['price'] }}</td>
                    <td>Grams: {{$item['grams']}} (${{ $item['pricePerGram'] }}), Ml: {{$item['ml']}} (${{ $item['pricePerMl'] }}), Amount: {{$item['amount']}} (${{ $item['pricePerAmount'] }})</td>
                    <td><a href="{{ $item['url'] }}" target="_blank">{{ $item['store_name'] }}</a></td>
                </tr> 
            @endforeach
        </tbody>
    </table>
</div>
@endsection
