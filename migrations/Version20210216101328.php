<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216101328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brands (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listings (id INT AUTO_INCREMENT NOT NULL, model_id INT DEFAULT NULL, sellers_id INT DEFAULT NULL, creation_year DATE NOT NULL, km INT NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, publish_at DATETIME NOT NULL, INDEX IDX_9A7BD98E7975B7E7 (model_id), INDEX IDX_9A7BD98E18F33F75 (sellers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE models (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E4D6300944F5D008 (brand_id), INDEX IDX_E4D6300912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sellers (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(127) NOT NULL, phone_number VARCHAR(10) NOT NULL, location VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listings ADD CONSTRAINT FK_9A7BD98E7975B7E7 FOREIGN KEY (model_id) REFERENCES models (id)');
        $this->addSql('ALTER TABLE listings ADD CONSTRAINT FK_9A7BD98E18F33F75 FOREIGN KEY (sellers_id) REFERENCES sellers (id)');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D6300944F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D6300912469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE models DROP FOREIGN KEY FK_E4D6300944F5D008');
        $this->addSql('ALTER TABLE models DROP FOREIGN KEY FK_E4D6300912469DE2');
        $this->addSql('ALTER TABLE listings DROP FOREIGN KEY FK_9A7BD98E7975B7E7');
        $this->addSql('ALTER TABLE listings DROP FOREIGN KEY FK_9A7BD98E18F33F75');
        $this->addSql('DROP TABLE brands');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE listings');
        $this->addSql('DROP TABLE models');
        $this->addSql('DROP TABLE sellers');
    }
}
