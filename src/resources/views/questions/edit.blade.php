<x-layouts.app title="Cinnamon Cat | Edit Question">
    <div class="background-animation">
        <span>🌷</span>
        <span>💗</span>
        <span>✨</span>
        <span>🌸</span>
    </div>

    <div class="page-shell">
        <div class="panel-card centered-panel" style="max-width: 760px; width: 100%;">
            <div class="panel-header">
                <div>
                    <div class="eyebrow">🌸 Cozy poll studio</div>
                    <h1>Edit question</h1>
                    <p class="hero-text">Polish the wording or options for your poll.</p>
                </div>
                <a href="{{ route('questions.index') }}" class="secondary-btn">Back</a>
            </div>

            <form action="{{ route('questions.update', $question) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                @livewire('question-composer', ['question' => $question])
                <button type="submit" class="login-btn form-btn">🌷 Update question 🐈</button>
            </form>
        </div>
    </div>
</x-layouts.app>
