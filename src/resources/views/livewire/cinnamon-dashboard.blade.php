<div class="dashboard-shell">
    <div class="petal petal-one">🌸</div>
    <div class="petal petal-two">🌷</div>
    <div class="petal petal-three">🌼</div>

    <section class="hero-card">
        <div class="hero-copy">
            <p class="eyebrow">Cinnamon Cat • Garden</p>
            <h1>Welcome home, {{ $user->name ?? 'friend' }}.</h1>
            <p class="hero-text">A soft, polished space for your cozy little corner of the web.</p>
            <div class="hero-actions">
                <button type="button" class="primary-btn" wire:click="toggleDetails">{{ $showDetails ? 'Hide details' : 'Open garden notes' }}</button>
                <a href="/cinnamon" class="secondary-btn" wire:navigate>Visit cinnamon list</a>
            </div>
            <p class="status-text">{{ $message }}</p>
            @if ($showDetails)
                <div class="detail-panel">
                    <p>🌿 Fresh petals, calm colors, and a smooth experience made for browsing with ease.</p>
                </div>
            @endif
        </div>
        <div class="hero-illustration" aria-hidden="true">🐱🌷</div>
    </section>

    <section class="info-grid">
        <article class="info-card">
            <h2>Lovely flow</h2>
            <p>Every interaction feels light, friendly, and responsive without a full page refresh.</p>
        </article>
        <article class="info-card">
            <h2>Soft style</h2>
            <p>Pastel tones, rounded shapes, and gentle motion create a polished cat-themed glow.</p>
        </article>
        <article class="info-card">
            <h2>Thoughtful forms</h2>
            <p>Validation and clear feedback make every action feel dependable and welcoming.</p>
        </article>
    </section>
</div>
