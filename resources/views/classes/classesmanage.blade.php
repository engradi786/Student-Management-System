@extends('layouts.app')
@section('content')
<div class="d-flex">

    {{-- Sidebar --}}
    <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh; position: fixed;">
        <h4 class="text-center mb-4">Dashboard</h4>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('index') }}" class="nav-link text-white ajax-link">
                    🏠 Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('classesmanage') }}" class="nav-link text-white ajax-link">
                    Manage Classes
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('attendance') }}" class="nav-link text-white ajax-link">
                    📝 Attendance
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('students') }}" class="nav-link text-white ajax-link">
                    👨‍🎓 Students
                </a>
            </li>
        </ul>

        {{-- Logout --}}
        <a href="{{ route('logout') }}"
           class="nav-link text-danger mt-4"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           🚪 Logout
        </a>

        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>
    </div>

    {{-- Main Content --}}
    <div class="flex-grow-1 p-4" style="margin-left: 250px;">
        <h2>Manage Classes</h2>
        <p>This is the Manage Classes page.</p>



















        
























    
 


@endsection
