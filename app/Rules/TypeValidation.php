<?php

namespace App\Rules;

use Closure;
use NumberFormatter;
use Illuminate\Contracts\Validation\ValidationRule;

class TypeValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $index => $item) {
            if (!is_int($item)) {
                $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL);
                $fail("$attribute " . $numberFormatter->format($index) . " value is not integer!");
            }
        }
    }
}
