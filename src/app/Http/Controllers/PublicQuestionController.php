<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicAnswerRequest;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublicQuestionController extends Controller
{
    public function __construct(private readonly QuestionService $questionService)
    {
    }

    public function show(Question $question): View
    {
        abort_unless($question->status === 'published', 404);

        $question->load(['options', 'results.option']);

        return view('questions.public-show', compact('question'));
    }

    public function answer(PublicAnswerRequest $request, Question $question): RedirectResponse
    {
        abort_unless($question->status === 'published', 404);

        try {
            $this->questionService->submitAnswer($question->id, $request->input('question_option_id'), $request->input('visitor_token'));
        } catch (\RuntimeException $exception) {
            return back()->withErrors(['visitor_token' => $exception->getMessage()]);
        }

        return redirect()->route('public.questions.result', $question)->with('success', 'Your answer was recorded.');
    }

    public function result(Question $question): View
    {
        abort_unless($question->status === 'published', 404);

        $question->load(['options', 'results.option']);

        return view('questions.public-result', compact('question'));
    }
}
