<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Request;

class ValidateCart implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    private $b;
    public function __construct($b)
    {
        $this->b=$b;
    }
     // Hàm validate để kiểm tra giá trị của attribute và value
     public function validate($attribute, $value, $fail): void
     {
        var_dump($value, $this->b);
         if ($value > $this->b) {
             $fail('The quantity must be less than ' . $this->b . '.');
         }
     }
}
