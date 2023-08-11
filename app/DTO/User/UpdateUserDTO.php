<?php

namespace App\DTO\User;

use App\Http\Requests\User\UpdateUserRequest;

class UpdateUserDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $bio,
        public readonly ?string $image,
    ) {
    }

    public static function fromRequest(UpdateUserRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            bio: $request->validated('bio'),
            image: $request->validated('image'),
        );
    }
}
