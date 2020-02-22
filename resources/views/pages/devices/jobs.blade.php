@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Devices</div>
                    <device-jobs-list></device-jobs-list>
                </div>
            </div>
        </div>
    </div>
@endsection
