<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $label;
    public $buttonType;
    public $size;
    public $variant;
    public $radius;
    public $isLoading;
    public $loadingPosition;
    public $labelLoading;
    public $visibleOn;

    public function __construct(
        $label = null,
        $buttonType = 'solid',
        $size = 'sm',
        $variant = 'primary',
        $radius = 'xs',
        $isLoading = false,
        $loadingPosition = 'right',
        $labelLoading = 'Loading...',
        $visibleOn = 'all'
    ) {
        $this->label = $label;
        $this->buttonType = $buttonType;
        $this->size = $size;
        $this->variant = $variant;
        $this->radius = $radius;
        $this->isLoading = $isLoading;
        $this->loadingPosition = $loadingPosition;
        $this->labelLoading = $labelLoading;
        $this->visibleOn = $visibleOn;
    }

    public function render()
    {
        return view('components.button');
    }
}

