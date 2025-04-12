<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LinkButton extends Component
{
    public $href;
    public $variant;

    public function __construct($href, $variant = 'primary')
    {
        $this->href = $href;
        $this->variant = $variant;
    }

    public function render()
    {
        return view('components.link-button');
    }
}

