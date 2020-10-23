<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023090934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, universe_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_archived TINYINT(1) NOT NULL, illustration VARCHAR(255) DEFAULT NULL, INDEX IDX_232B318C5CD9AF2 (universe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, number INT DEFAULT NULL, create_at DATETIME NOT NULL, is_archived TINYINT(1) DEFAULT NULL, INDEX IDX_9065174467B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE master (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, illustration VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE master_game (master_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_89E1CE513B3DB11 (master_id), INDEX IDX_89E1CE5E48FD905 (game_id), PRIMARY KEY(master_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, illustration VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, invoices_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, release_in VARCHAR(20) NOT NULL, page_number INT NOT NULL, price NUMERIC(5, 2) NOT NULL, create_at DATETIME NOT NULL, illustration VARCHAR(255) DEFAULT NULL, INDEX IDX_D34A04AD2454BA75 (invoices_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE universe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, icon VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, is_archived TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(52) NOT NULL, lastname VARCHAR(52) NOT NULL, screenname VARCHAR(55) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(16) NOT NULL, birthday VARCHAR(10) DEFAULT NULL, register_at DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, agree_terms_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C5CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174467B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE master_game ADD CONSTRAINT FK_89E1CE513B3DB11 FOREIGN KEY (master_id) REFERENCES master (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE master_game ADD CONSTRAINT FK_89E1CE5E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD2454BA75 FOREIGN KEY (invoices_id) REFERENCES invoice (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE master_game DROP FOREIGN KEY FK_89E1CE5E48FD905');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD2454BA75');
        $this->addSql('ALTER TABLE master_game DROP FOREIGN KEY FK_89E1CE513B3DB11');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C5CD9AF2');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174467B3B43D');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE master');
        $this->addSql('DROP TABLE master_game');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE universe');
        $this->addSql('DROP TABLE user');
    }
}
