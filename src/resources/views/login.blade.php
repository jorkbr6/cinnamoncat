<x-layouts.app>
    {{-- icon for background --}}
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
    <div class="login-card">
        <div id="cat" class="cat">🌷🐱</div>

        <h1>Cinnamon Cat</h1>
        <p class="subtitle">Login to your cozy cinnamon account ✨</p>

        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email">📧 Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus>

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">🔒 Password</label>
                <input type="password"
                       id="password"
                       name="password"
                       required>

                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login-btn">
                🌷 Login 🐈
            </button>
        </form>

        <div class="footer">
            Don't have an account?
            <a href="#">Sign Up</a>
        </div>
    </div>

    {{-- Optional sound --}}
    {{-- <audio id="angrySound">
        <source src="/sounds/cat-angry.mp3" type="audio/mpeg">
    </audio> --}}

    <style>
        body {
            background: linear-gradient(135deg, #fff0f6, #ffeef8);
            font-family: 'Arial', sans-serif;
        }

        .login-card {
            width: 400px;
            margin: 80px auto;
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(255, 182, 193, 0.3);
            text-align: center;
        }

        .cat {
            font-size: 70px;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
            display: inline-block;
        }

        .subtitle {
            color: #888;
            margin-bottom: 30px;
        }

        .input-group {
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ffd6e8;
            border-radius: 12px;
            outline: none;
        }

        input:focus {
            border-color: #ff99cc;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 15px;
            background: linear-gradient(135deg, #ff99cc, #ff66b2);
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            transform: scale(1.03);
        }

        .error-message {
            color: #ff4d6d;
            margin-top: 6px;
            font-size: 14px;
        }

        .footer {
            margin-top: 20px;
            color: #888;
        }

        .footer a {
            color: #ff66b2;
            text-decoration: none;
        }

        /* Normal animation */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* Error animation */
        .cat.error {
            animation: angryShake 0.4s infinite;
        }

        @keyframes angryShake {
            0%   { transform: translateX(0) rotate(0deg); }
            25%  { transform: translateX(-8px) rotate(-8deg); }
            50%  { transform: translateX(8px) rotate(8deg); }
            75%  { transform: translateX(-8px) rotate(-8deg); }
            100% { transform: translateX(0) rotate(0deg); }
        }

        /* Success animation */
        .cat.success {
            animation: successSpin 1s ease;
        }

        @keyframes successSpin {
            0%   { transform: scale(1) rotate(0deg); }
            50%  { transform: scale(1.4) rotate(180deg); }
            100% { transform: scale(1) rotate(360deg); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cat = document.getElementById('cat');
            const form = document.getElementById('loginForm');
            const angrySound = document.getElementById('angrySound');

            // Error state from Laravel validation
            @if ($errors->any())
                cat.textContent = '😾🔥';
                cat.classList.add('error');

                // Optional sound
                // if (angrySound) {
                //     angrySound.play().catch(() => {});
                // }

                setTimeout(() => {
                    cat.classList.remove('error');
                    cat.textContent = '🐱🌷';
                }, 1500);
            @endif

            // Success animation before submit
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                cat.textContent = '😻✨';
                cat.classList.remove('error');
                cat.classList.add('success');

                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        });
    </script>
</x-layouts.app>