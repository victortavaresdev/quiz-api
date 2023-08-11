<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Option\OptionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Question
 */
class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'correctAnswer' => $this->correct_answer,
            'options' => OptionResource::collection($this->whenLoaded('options')),
        ];
    }
}
