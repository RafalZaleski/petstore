<?php

declare(strict_types=1);

namespace App\Modules\PetStore\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\PetApiConnector\Dto\PetDto;
use App\Modules\PetApiConnector\Services\PetApiConnectorService;
use App\Modules\PetStore\Requests\PetStoreRequest;
use App\Modules\PetStore\Requests\PetUpdateRequest;

class PetStoreController extends Controller
{
    public function __construct(private readonly PetApiConnectorService $petApiConnector)
    {
    }

    public function show(int $id)
    {
        return $this->petApiConnector->get($id);
    }

    public function store(PetStoreRequest $request)
    {
        $data = $request->validated();
        $petDto = new PetDto();
        $petDto->setDataFromRequest($data);

        return $this->petApiConnector->store($petDto);
    }

    public function update(PetUpdateRequest $request)
    {
        $data = $request->validated();
        $petDto = new PetDto();
        $petDto->setDataFromRequest($data);

        return $this->petApiConnector->store($petDto);
    }

    public function destroy(int $id)
    {
        return $this->petApiConnector->delete($id);
    }
}