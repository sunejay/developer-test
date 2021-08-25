@extends('layouts.base')
@section('content')
<h1>welcome {{auth()->user()->name}}</h1>
@endsection