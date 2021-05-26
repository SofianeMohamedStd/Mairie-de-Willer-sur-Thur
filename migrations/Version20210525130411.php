<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525130411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE choices (id INT AUTO_INCREMENT NOT NULL, participation_id_id INT DEFAULT NULL, question_id_id INT DEFAULT NULL, INDEX IDX_5CE9639709813DC (participation_id_id), INDEX IDX_5CE96394FAF8F53 (question_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE choices_answer (choices_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_B4D11EF1163CD901 (choices_id), INDEX IDX_B4D11EF1AA334807 (answer_id), PRIMARY KEY(choices_id, answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choices ADD CONSTRAINT FK_5CE9639709813DC FOREIGN KEY (participation_id_id) REFERENCES participation (id)');
        $this->addSql('ALTER TABLE choices ADD CONSTRAINT FK_5CE96394FAF8F53 FOREIGN KEY (question_id_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE choices_answer ADD CONSTRAINT FK_B4D11EF1163CD901 FOREIGN KEY (choices_id) REFERENCES choices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE choices_answer ADD CONSTRAINT FK_B4D11EF1AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD user_id_id INT DEFAULT NULL, ADD poll_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F19F5E396 FOREIGN KEY (poll_id_id) REFERENCES polls (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F9D86650F ON participation (user_id_id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F19F5E396 ON participation (poll_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choices_answer DROP FOREIGN KEY FK_B4D11EF1163CD901');
        $this->addSql('DROP TABLE choices');
        $this->addSql('DROP TABLE choices_answer');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F9D86650F');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F19F5E396');
        $this->addSql('DROP INDEX IDX_AB55E24F9D86650F ON participation');
        $this->addSql('DROP INDEX IDX_AB55E24F19F5E396 ON participation');
        $this->addSql('ALTER TABLE participation DROP user_id_id, DROP poll_id_id');
    }
}
