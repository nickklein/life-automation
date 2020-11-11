@extends('layouts.app')

@section('content')
<h3>Categories</h3>

<p><a href="{{ route('shopping.categories.create') }}" class="btn btn-primary">Add new category</a></p>
<categories-list inline-template>
    <div class="table-responsive-md">
            <table class="table">
                <thead class="thead">
                <th>Name</th>
                <th>Action</th>
            </thead>

            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td><a href="{{ route('shopping.categories.show', ['categoryId' => $item['sh_categories_user_id']]) }}">{{ $item['name'] }}</a></td>
                        <td>
                            <select name="status" :category_id="{{$item['sh_categories_user_id']}}" v-on:change="changeSelect">
                                <option value="0" {{ $item['status'] == 0 ? 'selected' : '' }}>Disabled</option>
                                <option value="1" {{ $item['status'] == 1 ? 'selected' : '' }}>Low</option>
                                <option value="2" {{ $item['status'] == 2 ? 'selected' : '' }}>Normal</option>
                                <option value="3" {{ $item['status'] == 3 ? 'selected' : '' }}>Priority</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</categories-list>
@endsection
