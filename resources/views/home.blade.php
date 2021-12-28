@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Laravel Vue Pusher Chat</div>
                <div class="card-body" id='app'>
                    <chat-component :user="{{ Auth::user() }}" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
