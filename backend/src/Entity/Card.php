<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\DrawCardsController;
use App\Controller\SortCardsController;
use App\Dto\Card\DrawCardsRequest;
use App\Dto\Card\DrawCardsResponse;
use App\Dto\Card\SortCardsRequest;
use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CardRepository::class)]
#[ApiResource(operations: [
    new GetCollection(
        uriTemplate: '/cards/draw',
        controller: DrawCardsController::class,
        openapiContext: [
            'parameters' => [
                [
                    'name' => 'limit',
                    'in' => 'query',
                    'type' => 'integer',
                    'example' => '10',
                    'description' => 'Number of cards wanted'
                ]
            ]
        ],
        paginationEnabled: false,
        input: DrawCardsRequest::class,
        output: DrawCardsResponse::class,
        name: 'draw'
    ),
    new Post(
        uriTemplate: '/cards/sort',
        controller: SortCardsController::class,
        normalizationContext: ['sortCards'],
        input: SortCardsRequest::class
    )
])]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['draw'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['draw'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['draw'])]
    private ?int $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }
}
