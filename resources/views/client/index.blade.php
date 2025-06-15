@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/clients.css">
@endpush
@section('title', 'Clients')

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp
    <header>
        <div class="header-left">
            <div class="burger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="14" cy="29" r="5" fill="none" stroke="#00A27F" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="34" cy="29" r="5" fill="none" stroke="#00A27F" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="24" cy="9" r="5" fill="none" stroke="#00A27F" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M24 44C24 38.4772 19.5228 34 14 34C8.47715 34 4 38.4772 4 44" stroke="#00A27F" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M44 44C44 38.4772 39.5228 34 34 34C28.4772 34 24 38.4772 24 44" stroke="#00A27F" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M34 24C34 18.4772 29.5228 14 24 14C18.4772 14 14 18.4772 14 24" stroke="#00A27F" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg> <span data-i18n="clients">Clients</span></h1>
        <div class="header-right">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M44 24V9H24H4V24V39H24" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M30 30C30 29 35 27 35 27C35 27 40 29 40 30C40 38 35 40 35 40C35 40 30 38 30 30Z" fill="none"
                    stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4 9L24 24L44 9" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <div class="user-info">
                <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <i class="fas fa-user-circle user-icon"></i>
                <div class="user-details">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="/profile" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ($user)
                                <span class="user-name">{{ $user->firstName }} {{ $user->lastName }}</span>
                                <span class="user-role">Admin</span>
                            @elseif ($employee)
                                <span class="user-name">{{ $employee->username }}</span>
                                <span class="user-role">Employee</span>
                            @endif
                        </a>
                    </li>
                </div>
            </div>
        </div>
        </div>
    </header>
    <div class="overlay"></div>

    <div class="main-content">
        <div class="client-actions">
            <div class="search-bar">
                <input type="text" data-i18n="search" placeholder="Search" />
                <button><svg width="24" height="24" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"
                            fill="none" stroke="white" stroke-width="4" stroke-linejoin="round" />
                        <path
                            d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"
                            stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M33.2216 33.2217L41.7069 41.707" stroke="white" stroke-width="4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
            </div>
            <button class="add-client">+ <span data-i18n="add_client"> Add Client</span></button>
        </div>
        <div class="client-content">
            <div class="client-table">
                <table>
                    <thead>
                        <tr>
                            <th data-i18n="id">ID</th>
                            <th data-i18n="name">Name</th>
                            <th data-i18n="phone">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->phone }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No clients found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Modal overlay -->
    <div id="clientModal" class="modal-overlay">
        <div class="modal">
            <h2 data-i18n="modal_title_add_client">Add Client</h2>
            <form action="{{ route('client.store') }}" method="POST">
                @csrf
                <label for="name" data-i18n="name_label">Name</label>
                <input type="text" id="name" name="name" placeholder="Client Name" required>

                <label for="phone" data-i18n="phone_label">Phone</label>
                <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

                <input type="hidden" name="user_id" value="{{ Auth::id() }}">


                <div class="modal-buttons">
                    <button type="button" id="cancelBtn" data-i18n="modal_cancel">Cancel</button>
                    <button type="submit" data-i18n="modal_add">Add</button>
                </div>
            </form>

        </div>
    </div>
    <script src="../js/clients.js"></script>
    <script src="../js/lang.js"></script>
@endsection
