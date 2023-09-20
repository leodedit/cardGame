<?php

namespace App\Dto\Card;

use App\Entity\Card;

class DrawCardsResponse
{
    public array $cards;
    public array $orderTypes;
    public array $orderValues;

    /**
     * @param array $cards
     * @param array $orderTypes
     * @param array $orderValues
     */
    public function __construct(array $cards, array $orderTypes, array $orderValues)
    {
        $this->cards = $cards;
        $this->orderTypes = $orderTypes;
        $this->orderValues = $orderValues;
    }
}