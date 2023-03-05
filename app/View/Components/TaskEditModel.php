<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TaskEditModel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tasks;
    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.task-edit-model');
    }
}
