<?php

namespace App\Controller;

use App\Dto\Card\DrawCardsResponse;
use App\Enum\Card\Type;
use App\Enum\Card\Value;
use App\Repository\CardRepository;
use ReflectionClass;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

/**
 * Controller used by ApiPlatform to draw cards from "/api/cards/draw" and get random orders for card types and card values
 * with the `limit` parameter used to select how many cards we want, default and fallback value is 10.
 */
#[AsController]
class DrawCardsController extends AbstractController
{
    /** @var CardRepository $cardRepository */
    private CardRepository $cardRepository;

    /**
     * @param CardRepository $cardRepository
     */
    public function __construct(CardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    public function __invoke(Request $request): Response
    {
        $limit = 10;
        $requestLimit = $request->query->get('limit');

        if (!empty($requestLimit) && is_numeric($requestLimit)) {
            $limit = $requestLimit;
        }

        $cards = $this->cardRepository->drawCards($limit);
        $orderTypes = $this->getEnumValues(Type::class);
        shuffle($orderTypes);
        $orderValues = $this->getEnumValues(Value::class);
        shuffle($orderValues);
        $drawCardsResponse = new DrawCardsResponse($cards, $orderTypes, $orderValues);

        return $this->json($drawCardsResponse);
    }

    /**
     * Get an array of all enum values of an Enum class
     *
     * @param string $enumClass Targeted Enum class
     * @throws ReflectionException
     *
     * @return array
     */
    private function getEnumValues(string $enumClass): array
    {
        $enumClass = new ReflectionClass($enumClass);
        return array_values($enumClass->getConstants());
    }
}