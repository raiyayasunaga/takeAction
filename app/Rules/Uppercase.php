<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strtoupper($value) === $value;
    }


    public function rules()
    {
      return [
        'start_date' => 'required|date_format:Y/m/d',
        'end_date' => [
          'required',
          'date_format:Y/m/d',
          function($attribute, $value, $fail) {
            $start_datetime = Carbon::parse($this->start_date);
            $end_datetime = Carbon::parse($this->end_date);
            if ($end_datetime <= $start_datetime) {
              $fail('終了日時は開始日時より後にしてください。');
            }
          },
        ],
      ];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be uppercase.';
    }
}
