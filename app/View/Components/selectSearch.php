<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class selectSearch extends Component
{
     public string $name;
    public string $label;
    public array $options;
    public ?string $selected;
    public ?string $placeholder;
    /**
     * Create a new component instance.
     */
    public function __construct(  string $name = 'vendor',
        string $label = 'Vendor',
        array $options = ['draft', 'diajukan', 'disetujui', 'dibatalkan'],
        ?string $selected = null,
        ?string $placeholder = null)
    {
        $this->name = $name;
        $this->label = $label;
        // Jika array numerik (tanpa key eksplisit), buat value = label
        $this->options = array_is_list($options) ? array_combine($options, $options) : $options;
        $this->selected = $selected;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-search');
    }
}
