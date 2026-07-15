<x-layouts.app title="Cinnamon Cat | Login">
    <div class="background-animation">
        <span>🐱</span>
        <span>💗</span>
        <span>🌷</span>
        <span>🐾</span>
        <span>🎀</span>
        <span>🌸</span>
        <span>✨</span>
        <span>🐈</span>
        <span>🐾</span>
        <span>🌷</span>
        <span>💖</span>
        <span>🐾</span>
        <span>🐈</span>
        <span>🌹</span>
    </div>

    <div class="page-shell">
        <div class="login-card">
            <div id="cat" class="cat">🌷🐱</div>

            <h1>Cinnamon Cat</h1>
            <p class="subtitle">Login to your cozy cinnamon account ✨</p>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <label for="email">📧 Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">🔒 Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="login-btn">🌷 Login 🐈</button>
            </form>

            <div class="footer">
                Need a cozy account?
                <a href="/cinnamon">Visit the cinnamon list</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cat = document.getElementById('cat');
            const form = document.getElementById('loginForm');

            @if ($errors->any())
                cat.textContent = '😾🔥';
                cat.classList.add('error');
                setTimeout(() => {
                    cat.classList.remove('error');
                    cat.textContent = '🐱🌷';
                }, 1500);
            @endif

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                cat.textContent = '😻✨';
                cat.classList.remove('error');
                cat.classList.add('success');

                setTimeout(() => {
                    form.submit();
                }, 800);
            });
        });
    </script>
</x-layouts.app>