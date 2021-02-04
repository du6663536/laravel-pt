@extends('live::layouts.master')

@section('content')
    <p>
        This view is loaded from module: {!! config('live.name') !!} room
    </p>
@endsection