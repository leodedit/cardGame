<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915214342 extends AbstractMigration
{
    private array $cardTypes = [
        'club',
        'diamond',
        'heart',
        'spade',
    ];

    private int $minCardValue = 1;
    private int $maxCardValue = 13;

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        foreach ($this->cardTypes as $cardType) {
            for ($i = $this->minCardValue; $i <= $this->maxCardValue; $i++) {
                $this->addSql('INSERT INTO `card` (`type`, `value`) VALUES (:type, :value);', ['type' => $cardType, 'value' => $i]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE `card`;');
    }
}
