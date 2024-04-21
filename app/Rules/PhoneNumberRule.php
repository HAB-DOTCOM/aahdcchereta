<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class PhoneNumberRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Validate phone number format: starts with +251 or 0, followed by 9 or 7, and then 8 digits
        return preg_match('/^(?:\+251|0)([79]\d{8})$/', $value);
    }

    public function message()
    {
        return ':attribute ስልክ ቁጥሩ ከ +251 ወይም 0 ጀምሮ በ9 ወይም 7 እና ከዚያም በ8 አሃዝ የሚጀምር ትክክለኛ የኢትዮጵያ ስልክ ቁጥር መሆን አለበት።';
    }
}

