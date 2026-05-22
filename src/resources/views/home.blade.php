<x-layouts.app>
<div class="card">
    <div class="cat">🐱</div>
    <h1>Welcome Home!</h1>
    <p class="subtitle">Your cozy Laravel project ✨</p>

    <div class="welcome">
        Hello, <strong>{{ auth()->user()->name }}</strong> 🌷
    </div>

    <!-- Navigation Form -->
    <form onsubmit="event.preventDefault(); window.location.href = document.getElementById('users').value;">
        <button type="submit" id="users" class="btn go-btn" value="{{ url('/users') }}">
            ✨ Go to User List
        </button>
    </form>
</div>
    @extends('shared.footer')
</x-layouts.app>