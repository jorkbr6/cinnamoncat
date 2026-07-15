<x-layouts.app title="Cinnamon Cat | Questions">
    <div class="background-animation">
        <span>🌸</span>
        <span>🐾</span>
        <span>✨</span>
        <span>🌷</span>
    </div>

    <div class="page-shell list-page">
        <div class="panel-card centered-panel" style="max-width: 960px; width: 100%;">
            <div class="panel-header">
                <div>
                    <div class="eyebrow">🌸 Cozy poll library</div>
                    <h1>Questions</h1>
                    <p class="hero-text">Create and view your cinnamon-inspired Q&amp;A prompts.</p>
                </div>
                <a href="{{ route('questions.create') }}" class="primary-btn">New question</a>
            </div>

            <div class="user-list">
                @forelse($questions as $question)
                    <a href="{{ route('public.questions.show', $question) }}" class="user-card info-card" style="text-decoration: none;">
                        <div class="user-badge">🐱</div>
                        <div class="flex-1">
                            <h3>{{ $question->title }}</h3>
                            <p class="mt-1 text-sm">{{ $question->description }}</p>
                        </div>
                        <span class="rounded-full bg-rose-100 px-3 py-1 text-sm font-semibold text-rose-700">{{ $question->status }}</span>
                    </a>
                @empty
                    <div class="empty-state">
                        <p>No questions yet. Start your first cozy poll.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
