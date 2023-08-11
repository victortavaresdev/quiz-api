<?php

namespace App\Services\Result;

use App\Models\Result;
use App\Models\User;

class ResultService
{
    public function store(array $total_points): Result
    {
        $result = Result::create([
            ...$total_points,
            'user_id' => auth('api')->user()->id,
        ]);

        return $result;
    }

    public function show(User $user): int
    {
        $resultsList = Result::where('user_id', $user->id)->get(['total_points']);
        $totalPoints = 0;

        foreach ($resultsList as $result) {
            $totalPoints += $result->total_points;
        }

        return $totalPoints;
    }
}
