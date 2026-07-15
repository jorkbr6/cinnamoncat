<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function __construct(private readonly QuestionService $questionService)
    {
    }

    public function index(): View
    {
        $questions = Question::with('user')->latest()->get();

        return view('questions.index', compact('questions'));
    }

    public function create(): View
    {
        return view('questions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'is_public' => ['nullable', 'boolean'],
            'options' => ['required', 'array', 'min:1'],
            'options.*.option_text' => ['required', 'string', 'max:255'],
        ]);

        $this->questionService->createQuestion($data, $request->user()->id);

        return redirect()->route('questions.index')->with('success', 'Question created.');
    }

    public function show(Question $question): View
    {
        $question->load(['user', 'options', 'results.option']);

        return view('questions.show', compact('question'));
    }

    public function edit(Question $question): View
    {
        $question->load('options');

        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question): RedirectResponse
    {
        abort_unless($request->user()?->can('update', $question), 403);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'is_public' => ['nullable', 'boolean'],
            'options' => ['required', 'array', 'min:1'],
            'options.*.option_text' => ['required', 'string', 'max:255'],
        ]);

        $this->questionService->updateQuestion($question, $data);

        return redirect()->route('questions.index')->with('success', 'Question updated.');
    }

    public function destroy(Request $request, Question $question): RedirectResponse
    {
        abort_unless($request->user()?->can('delete', $question), 403);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted.');
    }
}
