<?php

declare(strict_types=1);

namespace App\Modules\PetApiConnector\Dto;

use App\Modules\PetApiConnector\Enums\PetStatusEnum;
use App\Modules\PetStore\Requests\PetStoreRequest;
use App\Modules\PetStore\Requests\PetUpdateRequest;

class PetDto
{
    private int $id;
    private PetCategoryDto $category;
    private string $name;
    private array $photoUrls;
    // tags nowe dto 
    private array $tags;
    private PetStatusEnum $status;

    public function setDataFromRequest(PetStoreRequest|PetUpdateRequest $request): self
    {
        $this->setId($request['id'])
            ->setName($request['name'])
            ->setCategory(new PetCategoryDto($request['category_id'], $request['categoty_name']))
            ->setStatus($request['status']);

        foreach ($request['photoUrls'] as $photoUrl) {
            $this->addPhotoUrl($photoUrl);
        }
        foreach ($request['tags'] as $tag) {
            $this->addTag(new PetTagDto($tag['id'], $tag['name']));
        }

        return $this;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setCategory(PetCategoryDto $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function addPhotoUrl(string $photoUrl): self
    {
        $this->photoUrls[] = $photoUrl;

        return $this;
    }

    public function addTag(PetTagDto $tag): self
    {
        $this->tags[] = $tag;

        return $this;
    }

    public function setStatus(PetStatusEnum $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'photoUrls' => $this->photoUrls,
            'tags' => $this->getTagsArray(),
            'status' => $this->status,
        ];
    }

    private function getTagsArray(): array
    {
        $tags = [];

        foreach ($this->tags as $tag) {
            $tags[] = [
                'id' => $tag->id,
                'name' => $tag->name,
            ];
        }

        return $tags;
    }
}