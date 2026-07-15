<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\QuestionResult;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    public function createQuestion(array $data, int $userId): Question
    {
        return DB::transaction(function () use ($data, $userId): Question {
            $question = Question::create([
                'user_id' => $userId,
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? 'draft',
                'is_public' => (bool) ($data['is_public'] ?? false),
            ]);

            foreach ($data['options'] as $index => $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'sort_order' => $index + 1,
                ]);
            }

            return $question;
        });
    }

    public function updateQuestion(Question $question, array $data): Question
    {
        return DB::transaction(function () use ($question, $data): Question {
            $question->update([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? 'draft',
                'is_public' => (bool) ($data['is_public'] ?? false),
            ]);

            $question->options()->delete();

            foreach ($data['options'] as $index => $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'sort_order' => $index + 1,
                ]);
            }

            return $question;
        });
    }

    public function submitAnswer(int $questionId, int $optionId, string $visitorToken): Answer
    {
        return DB::transaction(function () use ($questionId, $optionId, $visitorToken): Answer {
            $question = Question::findOrFail($questionId);

            $existing = Answer::where('question_id', $questionId)
                ->where('visitor_token', $visitorToken)
                ->first();

            if ($existing) {
                throw new \RuntimeException('You have already answered this question.');
            }

            $answer = Answer::create([
                'question_id' => $questionId,
                'question_option_id' => $optionId,
                'visitor_token' => $visitorToken,
            ]);

            $this->refreshResults($question);

            return $answer;
        });
    }

    public function refreshResults(Question $question): void
    {
        $question->results()->delete();

        $totalAnswers = $question->answers()->count();

        if ($totalAnswers === 0) {
            return;
        }

        $options = $question->options()->get();
        $totals = $question->answers()
            ->select('question_option_id', DB::raw('count(*) as total'))
            ->groupBy('question_option_id')
            ->pluck('total', 'question_option_id');

        foreach ($options as $option) {
            $count = (int) ($totals[$option->id] ?? 0);
            $percentage = $totalAnswers > 0 ? round(($count / $totalAnswers) * 100, 1) : 0;

            QuestionResult::create([
                'question_id' => $question->id,
                'option_id' => $option->id,
                'answer_count' => $count,
                'percentage' => $percentage,
            ]);
        }
    }

    public function getQuestionResults(Question $question): Collection
    {
        return $question->results()->with('option')->get();
    }
}
