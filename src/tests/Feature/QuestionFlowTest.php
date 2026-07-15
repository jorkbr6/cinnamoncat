<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_create_question_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/questions/create');

        $response->assertOk();
    }

    public function test_authenticated_user_can_create_question_with_options(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/questions', [
            'title' => 'What is your favorite flower?',
            'description' => 'Choose the flower you love most.',
            'status' => 'published',
            'is_public' => true,
            'options' => [
                ['option_text' => 'Rose'],
                ['option_text' => 'Lily'],
            ],
        ]);

        $response->assertRedirect('/questions');
        $this->assertDatabaseHas('questions', ['title' => 'What is your favorite flower?']);
        $this->assertDatabaseHas('question_options', ['option_text' => 'Rose']);
    }

    public function test_user_can_edit_own_question(): void
    {
        $user = User::factory()->create();
        $question = Question::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->patch(route('questions.update', $question), [
            'title' => 'Updated title',
            'description' => 'Updated description',
            'status' => 'published',
            'is_public' => true,
            'options' => [['option_text' => 'Updated option']],
        ]);

        $response->assertRedirect('/questions');
        $this->assertDatabaseHas('questions', ['id' => $question->id, 'title' => 'Updated title']);
    }

    public function test_user_cannot_edit_another_users_question(): void
    {
        $owner = User::factory()->create();
        $viewer = User::factory()->create();
        $question = Question::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($viewer)->patch(route('questions.update', $question), [
            'title' => 'Attempted change',
            'description' => 'Nope',
            'status' => 'published',
            'is_public' => true,
            'options' => [['option_text' => 'Nope']],
        ]);

        $response->assertForbidden();
    }

    public function test_public_user_can_answer_question_and_result_is_calculated(): void
    {
        $user = User::factory()->create();
        $question = Question::factory()->create(['user_id' => $user->id, 'status' => 'published']);
        $option = QuestionOption::factory()->create(['question_id' => $question->id]);

        $response = $this->post(route('public.questions.answer', $question), [
            'question_option_id' => $option->id,
            'visitor_token' => 'visitor-1',
        ]);

        $response->assertRedirect(route('public.questions.result', $question));
        $this->assertDatabaseHas('answers', ['question_id' => $question->id, 'visitor_token' => 'visitor-1']);
        $this->assertDatabaseHas('question_results', ['question_id' => $question->id, 'option_id' => $option->id]);
    }

    public function test_duplicate_answer_is_prevented(): void
    {
        $user = User::factory()->create();
        $question = Question::factory()->create(['user_id' => $user->id, 'status' => 'published']);
        $option = QuestionOption::factory()->create(['question_id' => $question->id]);

        $this->post(route('public.questions.answer', $question), [
            'question_option_id' => $option->id,
            'visitor_token' => 'visitor-duplicate',
        ]);

        $response = $this->post(route('public.questions.answer', $question), [
            'question_option_id' => $option->id,
            'visitor_token' => 'visitor-duplicate',
        ]);

        $response->assertSessionHasErrors('visitor_token');
    }
}
