@extends('layouts.app')

@section('content')
<h3>Items</h3>
<p><a href="{{ route('shopping.items.create') }}" class="btn btn-primary">Add new item</a></p>
<div class="table-responsive-md">
        <table class="table">
            <thead class="thead">
            <th>Name</th>
        </thead>

        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td><a href="{{route('shopping.items.edit', ['itemId' => $item['sh_item_id']])}}">{{ $item['name'] }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
