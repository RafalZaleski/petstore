<?php

declare(strict_types=1);

namespace App\Modules\PetApiConnector\Enums;

enum PetStatusEnum: string
{
    case available = 'available';
    case pending = 'pending';
    case sold = 'sold';
}