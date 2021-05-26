<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517202040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions ADD polls_id INT NOT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D577F234C8 FOREIGN KEY (polls_id) REFERENCES polls (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D577F234C8 ON questions (polls_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D577F234C8');
        $this->addSql('DROP INDEX IDX_8ADC54D577F234C8 ON questions');
        $this->addSql('ALTER TABLE questions DROP polls_id');
    }
}
