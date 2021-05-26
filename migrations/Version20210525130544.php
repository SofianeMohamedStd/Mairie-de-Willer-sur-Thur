<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525130544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE selected_answers (choices_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_B894B898163CD901 (choices_id), INDEX IDX_B894B898AA334807 (answer_id), PRIMARY KEY(choices_id, answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE selected_answers ADD CONSTRAINT FK_B894B898163CD901 FOREIGN KEY (choices_id) REFERENCES choices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE selected_answers ADD CONSTRAINT FK_B894B898AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE choices_answer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE choices_answer (choices_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_B4D11EF1163CD901 (choices_id), INDEX IDX_B4D11EF1AA334807 (answer_id), PRIMARY KEY(choices_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE choices_answer ADD CONSTRAINT FK_B4D11EF1163CD901 FOREIGN KEY (choices_id) REFERENCES choices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE choices_answer ADD CONSTRAINT FK_B4D11EF1AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE selected_answers');
    }
}
