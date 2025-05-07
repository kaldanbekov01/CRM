@extends('layouts.app')

@section('title', 'Clients')

@section('content')
<header>
    <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="14" cy="29" r="5" fill="none" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="34" cy="29" r="5" fill="none" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="24" cy="9" r="5" fill="none" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M24 44C24 38.4772 19.5228 34 14 34C8.47715 34 4 38.4772 4 44" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M44 44C44 38.4772 39.5228 34 34 34C28.4772 34 24 38.4772 24 44" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M34 24C34 18.4772 29.5228 14 24 14C18.4772 14 14 18.4772 14 24" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
    </svg> <span data-i18n="clients">Clients</span></h1>
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
