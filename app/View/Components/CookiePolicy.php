<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CookiePolicy extends Component
{
    public function __construct(
        public string $class = 'border border-orange-400'
    ) {}

    public function render(): View
    {
        return view('components.cookie-policy');
    }
}
