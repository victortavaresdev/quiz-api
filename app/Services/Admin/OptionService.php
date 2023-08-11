<?php

namespace App\Services\Admin;

use App\Models\Option;
use App\Models\Question;

class OptionService
{
    public function store(Question $question, array $option_text): Option
    {
        $option = $question->options()->create($option_text);

        return $option;
    }
}
