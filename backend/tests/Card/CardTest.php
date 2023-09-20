<?php

namespace App\Tests\Card;

use App\Entity\Card;
use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CardTest extends KernelTestCase
{
    private CardRepository $cardRepository;

    protected function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $container = self::$kernel->getContainer();
        /** @var $cardRepository $cardRepository */
        $cardRepository = $container->get('app.repository.card');

        if (!$cardRepository instanceof CardRepository) {
            throw new \Exception('Repository app.repository.card is not properly registered');
        }

        $this->cardRepository = $cardRepository;
    }

    public function testAllCardsAreRegistered()
    {
        $cards = $this->cardRepository->findAll();

        $this->assertCount(52, $cards);
        $this->assertContainsOnlyInstancesOf(Card::class, $cards);
    }

    public function testDrawCards()
    {
        $cards = $this->cardRepository->drawCards(15);

        $this->assertCount(15, $cards);
        $this->assertContainsOnlyInstancesOf(Card::class, $cards);
    }
}