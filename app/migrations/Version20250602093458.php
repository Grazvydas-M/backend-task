<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250602093458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE trip_event CHANGE trip_id trip_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trip_event ADD CONSTRAINT FK_E1E58AE4A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E1E58AE4A5BC2E0E ON trip_event (trip_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP scooter_id, DROP trip_id
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE trip_event DROP FOREIGN KEY FK_E1E58AE4A5BC2E0E
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E1E58AE4A5BC2E0E ON trip_event
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trip_event CHANGE trip_id trip_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD scooter_id INT NOT NULL, ADD trip_id INT NOT NULL
        SQL);
    }
}
