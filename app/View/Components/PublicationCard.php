<?php

namespace App\View\Components;

use App\Models\Publication;
use Illuminate\View\Component;

class PublicationCard extends Component
{
    public $pub;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pub)
    {
        $this->pub = $pub;
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
