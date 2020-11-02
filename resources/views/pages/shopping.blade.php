@extends('layouts.app')

@section('content')
<h3>Shopping</h3>

<div class="btn-group" role="group" aria-label="Basic example">
    <a href="#" class="btn btn-primary">Items</a>
    <a href="#" class="btn btn-primary">New list</a>
  </div>

<table>
    <thead>
        <th>Name</th>
    </thead>

    <tbody>
        @foreach ($data as $item)
            <tr>
                <td><a href="#">{{ $item['name'] }}</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
