@extends('layouts.app')

@section('content')
    <h3>Devices</h3>
    <device-settings-list inline-template>
        <div class="table-responsive-md">
            <table class="table">
                <thead class="thead">
                    <th>ID</th>
                    <th>Key</th>
                    <th>Value</th>
                </thead>
                <tbody>
                    @foreach ($settings as $key => $setting)
                        <tr>
                            <td>{{ $setting["device_settings_id"] }}</td>
                            <td>{{ $setting["key"] }}</td>
                        <td><input type="text" v-on:keyup="action('{{ $setting["key"] }}', {{ $setting["device_id"] }}, $event.target.value)" :value="'{{ $setting['value'] }}'"></td>
                        </tr>        
                    @endforeach
                </tbody>
            </table>
        </div>
    </device-settings-list>

@endsection
