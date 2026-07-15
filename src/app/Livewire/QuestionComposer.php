<?php

namespace App\Livewire;

use App\Models\Question;
use Livewire\Component;

class QuestionComposer extends Component
{
    public array $options = [];
    public string $title = '';
    public string $description = '';
    public string $status = 'draft';
    public bool $is_public = false;
    public ?Question $question = null;

    public function mount(?Question $question = null): void
    {
        $this->question = $question;

        if ($question) {
            $this->title = $question->title;
            $this->description = $question->description ?? '';
            $this->status = $question->status;
            $this->is_public = (bool) $question->is_public;
            $this->options = $question->options->map(fn ($option) => ['option_text' => $option->option_text])->toArray();

            if ($this->options === []) {
                $this->options = [['option_text' => ''], ['option_text' => '']];
            }

            return;
        }

        $this->options = [
            ['option_text' => ''],
            ['option_text' => ''],
        ];
    }

    public function addOption(): void
    {
        $this->options[] = ['option_text' => ''];
    }

    public function removeOption(int $index): void
    {
        if (count($this->options) > 2) {
            unset($this->options[$index]);
            $this->options = array_values($this->options);
        }
    }

    public function render()
    {
        return view('livewire.question-composer');
    }
}
