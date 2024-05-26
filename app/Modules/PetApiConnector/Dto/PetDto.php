<?php

declare(strict_types=1);

namespace App\Modules\PetApiConnector\Dto;

use App\Modules\PetApiConnector\Enums\PetStatusEnum;

class PetDto
{
    private int $id;
    private ?PetCategoryDto $category = null;
    private string $name;
    private array $photoUrls;
    private ?array $tags = null;
    private PetStatusEnum $status;

    public function setDataFromRequest(array $request): self
    {
        $this->setId((int)$request['id'])
            ->setName($request['name'])
            ->setStatus(PetStatusEnum::tryFrom($request['status']));

        if (isset($request['category'])) {
            $this->setCategory(new PetCategoryDto((int)$request['category']['id'], $request['category']['name']));
        }

        foreach ($request['photoUrls'] as $photoUrl) {
            $this->addPhotoUrl($photoUrl);
        }
        foreach ($request['tags'] as $tag) {
            $this->addTag(new PetTagDto((int)$tag['id'], $tag['name']));
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
                'id' => $this->category?->getId(),
                'name' => $this->category?->getName(),
            ],
            'photoUrls' => $this->photoUrls,
            'tags' => $this->getTagsArray(),
            'status' => $this->status,
        ];
    }

    private function getTagsArray(): array
    {
        $tags = [];

        if ($this->tags) {
            foreach ($this->tags as $tag) {
                $tags[] = [
                    'id' => $tag->getId(),
                    'name' => $tag->getName(),
                ];
            }
        }

        return $tags;
    }
}