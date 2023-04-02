<?php

namespace App\View\Components\Tasks\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ViewTask extends Component
{
    public $task;
    /**
     * Create a new component instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks.modals.view-task');
    }
}
