@extends('dashboard.layout.main')
@section('container')
    <h1> may name is {{ Auth::user()->name }}</h1>
@endsection
