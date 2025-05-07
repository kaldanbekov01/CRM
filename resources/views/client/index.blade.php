@extends('layouts.app')

@section('title', 'Clients')

@section('content')
<header>
    <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
            xmlns="http://www.w3.org/2000/svg">
        </svg> Clients </h1>
    <div class="header-right">
    </div>
</header>
<div class="main-content">
    <div class="container text-center mt-5">
        <h2 class="text-muted">🔒 Not available now</h2>
        <p class="lead">This functionality is currently under development. Please check back later.</p>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">← Back</a>
    </div>
</div>
<script src="../js/lang.js"></script>
@endsection
