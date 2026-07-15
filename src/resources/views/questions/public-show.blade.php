<x-layouts.app title="Cinnamon Cat | {{ $question->title }}">
    <div class="background-animation">
        <span>🌷</span>
        <span>🐾</span>
        <span>✨</span>
        <span>🌸</span>
    </div>

    <div class="page-shell">
        <div class="panel-card centered-panel" style="max-width: 760px; width: 100%;">
            <div class="panel-header">
                <div>
                    <div class="eyebrow">🐾 Cozy opinion card</div>
                    <h1>{{ $question->title }}</h1>
                    <p class="hero-text">{{ $question->description }}</p>
                </div>
            </div>

            <form action="{{ route('public.questions.answer', $question) }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="visitor_token" value="{{ request()->cookie('question_visitor') ?: uniqid('visitor-', true) }}">
                <div class="space-y-3">
                    @foreach($question->options as $option)
                        <label class="flex cursor-pointer items-center gap-3 rounded-2xl border border-rose-100 bg-rose-50/70 p-4 transition hover:border-rose-300 hover:bg-rose-100/70">
                            <input type="radio" name="question_option_id" value="{{ $option->id }}" class="h-4 w-4 border-rose-300 text-rose-500" />
                            <span class="text-slate-700">{{ $option->option_text }}</span>
                        </label>
                    @endforeach
                </div>

                @if($errors->any())
                    <p class="mt-4 text-sm font-medium text-rose-600">{{ $errors->first('visitor_token') }}</p>
                @endif

                <button type="submit" class="login-btn form-btn">🌷 Submit answer 🐈</button>
            </form>
        </div>
    </div>
</x-layouts.app>
