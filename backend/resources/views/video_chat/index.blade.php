@extends('layouts.app')
@section('content')
    <video_chat-component
        :user="{{ $user }}"
        :others="{{ $others }}"
        pusher-key="{{ config('broadcasting.connections.pusher.key') }}"
        pusher-cluster="{{ config('broadcasting.connections.pusher.options.cluster') }}"
    ></video_chat-component>
@endsection
