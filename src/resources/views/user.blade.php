<x-layouts.app title="Cinnamon Cat | Members">
    <div class="page-shell list-page" x-data="{ open: false }">
        <section class="panel-card centered-panel">
            @if (session('status'))
                <div class="status-banner">{{ session('status') }}</div>
            @endif

            <div class="panel-header">
                <div>
                    <p class="eyebrow">Cinnamon Cat • Members</p>
                    <h1>Meet the cozy cinnamon crew</h1>
                    <p class="hero-text">A welcoming list of friends, flowers, and bright little updates.</p>
                </div>
                <button type="button" class="primary-btn" @click="open = true">➕ Add a new friend</button>
            </div>

            <div class="user-list">
                @forelse ($users as $user)
                    <article class="user-card">
                        <div class="user-badge">🐱</div>
                        <div>
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->email }}</p>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <p>No cinnamon friends yet. Add the first one with the button above.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    <div class="modal" id="modal" x-show="open" x-cloak @click.self="open = false">
        <div class="modal-content">
            <h3>🌷 Add a cinnamon friend</h3>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <button type="submit" class="primary-btn form-btn">Create friend</button>
            </form>
            <button type="button" class="secondary-btn form-btn" @click="open = false">Cancel</button>
        </div>
    </div>

    @include('shared.footer')
</x-layouts.app>