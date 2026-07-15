<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CinnamonDashboard extends Component
{
    public string $message = 'Welcome back, sweet friend.';

    public bool $showDetails = false;

    public function toggleDetails(): void
    {
        $this->showDetails = ! $this->showDetails;
        $this->message = $this->showDetails
            ? 'Your garden is blooming with fresh ideas.'
            : 'Welcome back, sweet friend.';
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.cinnamon-dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
