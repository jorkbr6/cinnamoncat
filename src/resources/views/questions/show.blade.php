<x-layouts.app title="Cinnamon Cat | {{ $question->title }}">
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
                    <div class="eyebrow">🌷 Cozy poll preview</div>
                    <h1>{{ $question->title }}</h1>
                    <p class="hero-text">{{ $question->description }}</p>
                </div>
                <span class="rounded-full bg-rose-100 px-3 py-1 text-sm font-semibold text-rose-700">{{ $question->status }}</span>
            </div>

            <div class="detail-panel">
                <h2 class="text-xl font-semibold text-rose-700">Options</h2>
                <ul class="mt-4 space-y-2">
                    @foreach($question->options as $option)
                        <li class="rounded-2xl border border-rose-100 bg-white/80 p-3 text-slate-700">{{ $option->option_text }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-layouts.app>
