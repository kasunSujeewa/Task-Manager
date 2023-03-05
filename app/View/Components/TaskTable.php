<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TaskTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tasks;
    public $today;
    public function __construct($tasks,$today)
    {
        $this->tasks = $tasks;
        $this->today = $today;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.task-table');
    }
}
