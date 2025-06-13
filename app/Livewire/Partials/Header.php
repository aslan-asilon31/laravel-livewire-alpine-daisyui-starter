<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Mary\Traits\Toast;

class Header extends Component
{
    use Toast;

    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    public function render()
    {
        return view('livewire.partials.header');
    }

    public function mount() {}
}
