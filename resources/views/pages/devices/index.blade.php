@extends('layouts.app')

@section('content')
    <h3>Devices</h3>
    <devices-list inline-template>
        <div class="table-responsive-md">
            <table class="table">
                <thead class="thead">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Last Online</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{$item["device_id"]}}</td>
                            <td><a href="{{ route('device.settings', ['deviceId' => $item['device_id']]) }}">{{$item["device_name"]}}</a></td>
                            <td>{{$item["last_online"]}}</td>
                            <td><a href="#" class="btn btn-primary" v-on:click="action('reboot', {{$item['device_id']}})">Reboot</a> <a href="#" class="btn btn-primary" v-on:click="action('shutdown', {{$item['device_id']}})">Shutdown</a> <a href="#" class="btn btn-primary" v-on:click="action('update', {{$item['device_id']}})">Update</a></td>
                        </tr>        
                    @endforeach
                </tbody>
            </table>
            </div>
    </devices-list>

@endsection
