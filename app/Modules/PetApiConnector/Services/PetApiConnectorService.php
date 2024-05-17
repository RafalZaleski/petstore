<?php

declare(strict_types=1);

namespace App\Modules\PetApiConnector\Services;

use App\Modules\PetApiConnector\Dto\PetDto;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class PetApiConnectorService
{
    const BASE_URL = 'https://petstore.swagger.io/v2/pet/';

    public function get(int $id): Response
    { 
        $response = Http::acceptJson()
            ->get(self::BASE_URL . $id);

        return $response;
    }

    public function store(PetDto $petDto): Response
    { 
        $response = Http::acceptJson()
            ->post(self::BASE_URL, $petDto->toArray());

        return $response;
    }

    public function update(PetDto $petDto): Response
    { 
        $response = Http::acceptJson()
            ->put(self::BASE_URL, $petDto->toArray());

        return $response;
    }

    public function delete(int $id): Response
    { 
        $response = Http::acceptJson()
            ->delete(self::BASE_URL . $id);

        return $response;
    }
}