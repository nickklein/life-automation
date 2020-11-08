@extends('layouts.app')

@section('content')
<h3>Categories</h3>

<p><a href="{{ route('shopping.categories.create') }}" class="btn btn-primary">Add new category</a></p>
<div class="table-responsive-md">
        <table class="table">
            <thead class="thead">
            <th>Name</th>
        </thead>

        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td><a href="{{ route('shopping.categories.show', ['categoryId' => $item['sh_categories_user_id']]) }}">{{ $item['name'] }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
