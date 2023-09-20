<?php

namespace App\Service;

class CardService
{
    /**
     * Sort given Cards with defined orders
     *
     * @param array $cards Cards to sort
     * @param array $orderTypes Defined order for card type used to sort the deck
     * @param array $orderValues Defined order for card value used to sort the deck
     * @return array
     */
    public function sortCards(array $cards, array $orderTypes, array $orderValues): array
    {
        $cardComparison = function ($a, $b) use ($orderTypes, $orderValues) {
            $result1 = array_search($a->getType(), $orderTypes) - array_search($b->getType(), $orderTypes);

            if ($result1 === 0) {
                $result2 = array_search($a->getValue(), $orderValues) - array_search($b->getValue(), $orderValues);
                return $result2;
            }

            return $result1;
        };

        usort($cards, $cardComparison);

        return $cards;
    }
}