<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526093917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, questions_id INT DEFAULT NULL, wording VARCHAR(255) NOT NULL, INDEX IDX_DADD4A25BCB134CE (questions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE choices (id INT AUTO_INCREMENT NOT NULL, participation_id_id INT DEFAULT NULL, question_id_id INT DEFAULT NULL, INDEX IDX_5CE9639709813DC (participation_id_id), INDEX IDX_5CE96394FAF8F53 (question_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selected_answers (choices_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_B894B898163CD901 (choices_id), INDEX IDX_B894B898AA334807 (answer_id), PRIMARY KEY(choices_id, answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, poll_id_id INT DEFAULT NULL, created_date DATETIME NOT NULL, INDEX IDX_AB55E24F9D86650F (user_id_id), INDEX IDX_AB55E24F19F5E396 (poll_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE polls (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, published_date DATETIME NOT NULL, finished_date DATETIME NOT NULL, answer_published_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, polls_id INT NOT NULL, wording VARCHAR(255) NOT NULL, multiple_choice TINYINT(1) NOT NULL, INDEX IDX_8ADC54D577F234C8 (polls_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(15) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25BCB134CE FOREIGN KEY (questions_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE choices ADD CONSTRAINT FK_5CE9639709813DC FOREIGN KEY (participation_id_id) REFERENCES participation (id)');
        $this->addSql('ALTER TABLE choices ADD CONSTRAINT FK_5CE96394FAF8F53 FOREIGN KEY (question_id_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE selected_answers ADD CONSTRAINT FK_B894B898163CD901 FOREIGN KEY (choices_id) REFERENCES choices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE selected_answers ADD CONSTRAINT FK_B894B898AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F19F5E396 FOREIGN KEY (poll_id_id) REFERENCES polls (id)');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D577F234C8 FOREIGN KEY (polls_id) REFERENCES polls (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE selected_answers DROP FOREIGN KEY FK_B894B898AA334807');
        $this->addSql('ALTER TABLE selected_answers DROP FOREIGN KEY FK_B894B898163CD901');
        $this->addSql('ALTER TABLE choices DROP FOREIGN KEY FK_5CE9639709813DC');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F19F5E396');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D577F234C8');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25BCB134CE');
        $this->addSql('ALTER TABLE choices DROP FOREIGN KEY FK_5CE96394FAF8F53');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F9D86650F');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE choices');
        $this->addSql('DROP TABLE selected_answers');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE polls');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
    }
}
