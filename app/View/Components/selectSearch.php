<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectSearch extends Component
{
    public string $name;
    public string $label;
    public array $options;
    public array $selected;   // <-- selalu dipaksa array
    public ?string $placeholder;

    public function __construct(
        string $name = 'vendor',
        string $label = 'Vendor',
        array $options = ['draft', 'diajukan', 'disetujui', 'dibatalkan'],
        string|array|null $selected = null,
        ?string $placeholder = null
    ) {
        $this->name = $name;
        $this->label = $label;

        // Jika array numerik, jadikan key=value
        if (is_array($options) && function_exists('array_is_list') && array_is_list($options)) {
            $this->options = array_combine($options, $options);
        } else {
            $this->options = (array) $options;
        }

        // Selalu jadikan array agar aman
        $this->selected = is_array($selected) ? $selected : (array) $selected;

        $this->placeholder = $placeholder;
    }

    public function render(): View|Closure|string
    {
        return view('components.select-search');
    }
}
