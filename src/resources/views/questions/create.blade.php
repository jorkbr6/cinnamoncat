<x-layouts.app title="Cinnamon Cat | Create Question">
    <div class="background-animation">
        <span>🌷</span>
        <span>🐱</span>
        <span>✨</span>
        <span>🌸</span>
    </div>

    <div class="page-shell">
        <div class="panel-card centered-panel" style="max-width: 760px; width: 100%;">
            <div class="panel-header">
                <div>
                    <div class="eyebrow">🌷 Cozy poll studio</div>
                    <h1>Create a question</h1>
                    <p class="hero-text">Shape a little poll for your cinnamon community.</p>
                </div>
                <a href="{{ route('questions.index') }}" class="secondary-btn">Back</a>
            </div>

            <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
                @csrf
                @livewire('question-composer', ['question' => null])
                <button type="submit" class="login-btn form-btn">🌷 Save question 🐈</button>
            </form>
        </div>
    </div>
</x-layouts.app>
