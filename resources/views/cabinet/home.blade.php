@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Cabinet</li>
    </ul>
@endsection

@section('content')
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" href="{{route('cabinet.home')}}">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('cabinet.profile.home')}}">Profile</a></li>
    </ul>
@endsection