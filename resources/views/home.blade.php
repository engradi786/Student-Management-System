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
                <a href="{{ route('classes') }}" class="nav-link text-white ajax-link">
                    📚 Classes
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
    <div id="main-content" class="flex-grow-1" style="margin-left: 250px;">
        <div class="container mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Dashboard</div>
                <div class="card-body" id="ajax-content">
                    <h5>Welcome Back 👋</h5>
                    <p>You are logged in successfully.</p>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- jQuery for AJAX Loading --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.ajax-link').click(function(e) {
        e.preventDefault(); // prevent page reload
        var url = $(this).attr('href');

        // Highlight active link
        $('.ajax-link').removeClass('bg-primary');
        $(this).addClass('bg-primary');

        // Load content via AJAX
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#ajax-content').html(data);
            },
            error: function(xhr) {
                $('#ajax-content').html('<p class="text-danger">Error loading content.</p>');
            }
        });
    });
});
</script>
@endsection
