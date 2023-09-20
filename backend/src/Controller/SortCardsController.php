<?php

namespace App\Controller;

use App\Dto\Card\SortCardsRequest;
use App\Repository\CardRepository;
use App\Service\CardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Controller used by ApiPlatform to sort cards with the given order types and order values.
 */
#[AsController]
class SortCardsController extends AbstractController
{
    /**
     * @param CardRepository $cardRepository
     * @param CardService $cardService
     * @param SerializerInterface $serializer
     */
    public function __construct(
        private readonly CardRepository       $cardRepository,
        private readonly CardService $cardService,
        private readonly SerializerInterface  $serializer
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        $cardIds = [];
        $content = $request->getContent();

        /** @var SortCardsRequest $sortCardsRequest */
        $sortCardsRequest = $this->serializer->deserialize($content, SortCardsRequest::class, 'json');

        $cards = $sortCardsRequest->cards;
        $orderTypes = $sortCardsRequest->orderTypes;
        $orderValues = $sortCardsRequest->orderValues;

        if (empty($cards)) {
            throw new \Exception('cards is empty');
        }

        foreach ($cards as $card) {
            if (!empty($card['id'])) {
                $cardIds[] = $card['id'];
            }
        }

        $cards = $this->cardRepository->findBy(array('id' => $cardIds));

        $sortedCards = $this->cardService->sortCards($cards, $orderTypes, $orderValues);

        return $this->json($sortedCards);
    }
}