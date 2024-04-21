<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class CustomPasswordRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Minimum 8 characters, one capital, one special, one number
        return preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])\S{8,}$/', $value);
    }
    public function message()
    {
        return ':attribute የይለፍ ቃል ቢያንስ 8 ቁምፊዎች መሆን አለበት እና ቢያንስ አንድ አቢይ ሆሄያት፣ አንድ ቁጥር እና አንድ ልዩ ቁምፊ መያዝ አለበት።';
    }
}
