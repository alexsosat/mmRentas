<?php

namespace App\View\Components;

use App\Models\Publication;
use Illuminate\View\Component;

class PublicationCard extends Component
{
    public $pub;
    public $editable;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pub, $editable)
    {
        $this->pub = $pub;
        $this->editable = $editable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.publication-card', ['Publication' => Publication::all()->find($this->pub)]);
    }
}
