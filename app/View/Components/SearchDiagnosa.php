<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchDiagnosa extends Component
{
    /**
     * Create a new component instance.
     */
    public $action;
    public $placeholderNama;
    public $placeholderTanggal;
    public $buttonText;


    public function __construct($action, $placeholderNama, $placeholderTanggal, $buttonText)
    {
        //
        $this->action = $action;
        $this->placeholderNama = $placeholderNama;
        $this->placeholderTanggal = $placeholderTanggal;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-diagnosa');
    }
}
