@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs mb3">
        <li class="nav-item"><a class="nav-item" href="{{route('cabinet.home')}}">Dashboard</a></li>
        <li class="nav-item"><a class="nav-item active" href="{{route('cabinet.adverts.index')}}">Adverts</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('cabinet.profile.home')}}">Profile</a></li>
    </ul>
@endsection
