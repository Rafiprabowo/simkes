<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class searchForm extends Component
{
    public $action;
    public $placeholder;
    public $buttonText;

    /**
     * Create a new component instance.
     *
     * @param string $action
     * @param string $placeholder
     * @param string $buttonText
     * @param string $value
     */
    public function __construct($action, $placeholder = 'Search for…', $buttonText = 'Cari')
    {
        $this->action = $action;
        $this->placeholder = $placeholder;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.search-form'); // Pastikan path ke view benar
    }
}
