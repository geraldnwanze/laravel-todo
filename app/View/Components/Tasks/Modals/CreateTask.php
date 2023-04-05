<?php

namespace App\View\Components\Tasks\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateTask extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks.modals.create-task');
    }
}
