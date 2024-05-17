<?php

declare(strict_types=1);

namespace App\Modules\PetApiConnector\Dto;

readonly class PetTagDto
{
    public function __construct(private int $id, private string $name)
    {
    }
}