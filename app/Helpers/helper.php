<?php 

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;

if(! function_exists('upload')) {
    function upload($directory, $file, $filename= "") 
    {
        $extensi = $file->getClientOriginalExtension();
        $filename = "{$filename}_" . date('Ymdhis'). ".{$extensi}";

        Storage::disk('public')->putFileAs("/$directory",$file,$filename);
        return "/$directory/$filename";
    }
}
if(! function_exists('rupiah')) {
     function rupiah($amount, $withSymbol = true)
    {
        $formatted = number_format($amount, 0, ',', '.');
        return $withSymbol ? 'Rp ' . $formatted : $formatted;
    }
}
if(! function_exists('dollar')) {
    function dollar($amount, $withSymbol = true)
    {
        $formatted = number_format($amount, 2, '.', ',');
        return $withSymbol ? '$' . $formatted : $formatted;
    }
}
