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
    public string|array|null $selected;
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

        // Jika array numerik, jadikan nilai = label, tapi jangan memproses associative array
        if (is_array($options) && array_is_list($options)) {
            $this->options = array_combine($options, $options);
        } else {
            $this->options = (array) $options;
        }

        // Jika selected adalah string tunggal, ubah menjadi array untuk mempermudah pengecekan nilai terpilih
        $this->selected = is_array($selected) ? $selected : ($selected !== null ? [$selected] : []);
        $this->placeholder = $placeholder;
    }

    public function render(): View|Closure|string
    {
        return view('components.select-search');
    }
}
