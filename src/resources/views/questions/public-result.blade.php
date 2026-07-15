<x-layouts.app title="Cinnamon Cat | Results">
    <div class="background-animation">
        <span>🌷</span>
        <span>💖</span>
        <span>✨</span>
        <span>🌸</span>
    </div>

    <div class="page-shell">
        <div class="panel-card centered-panel" style="max-width: 760px; width: 100%;">
            <div class="panel-header">
                <div>
                    <div class="eyebrow">🌷 Result garden</div>
                    <h1>{{ $question->title }}</h1>
                    <p class="hero-text">{{ $question->description }}</p>
                </div>
            </div>

            <div class="detail-panel">
                <h2 class="text-xl font-semibold text-rose-700">Results</h2>
                <div class="mt-4 space-y-3">
                    @foreach($question->results as $result)
                        <div class="rounded-2xl border border-rose-100 bg-white/80 p-4">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-slate-700">{{ $result->option->option_text }}</span>
                                <span class="text-sm font-semibold text-rose-700">{{ $result->percentage }}%</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-rose-100">
                                <div class="h-2 rounded-full bg-rose-400" style="width: {{ $result->percentage }}%"></div>
                            </div>
                            <p class="mt-2 text-sm text-slate-500">{{ $result->answer_count }} answers</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
