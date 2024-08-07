<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NameSearch extends Component
{
    /**
     * Create a new component instance.
     */
    public $action;
    public $buttonText;
    public $placeholder;
    public function __construct($action, $buttonText, $placeholder)
    {
        //
        $this->action = $action;
        $this->buttonText = $buttonText;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.name-search');
    }
}
