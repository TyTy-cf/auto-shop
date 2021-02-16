<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216104629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listings ADD models_id INT NOT NULL, ADD sellers_id INT NOT NULL');
        $this->addSql('ALTER TABLE listings ADD CONSTRAINT FK_9A7BD98ED966BF49 FOREIGN KEY (models_id) REFERENCES models (id)');
        $this->addSql('ALTER TABLE listings ADD CONSTRAINT FK_9A7BD98E18F33F75 FOREIGN KEY (sellers_id) REFERENCES sellers (id)');
        $this->addSql('CREATE INDEX IDX_9A7BD98ED966BF49 ON listings (models_id)');
        $this->addSql('CREATE INDEX IDX_9A7BD98E18F33F75 ON listings (sellers_id)');
        $this->addSql('ALTER TABLE models ADD brands_id INT NOT NULL, ADD categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D63009E9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D63009A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_E4D63009E9EEC0C7 ON models (brands_id)');
        $this->addSql('CREATE INDEX IDX_E4D63009A21214B7 ON models (categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listings DROP FOREIGN KEY FK_9A7BD98ED966BF49');
        $this->addSql('ALTER TABLE listings DROP FOREIGN KEY FK_9A7BD98E18F33F75');
        $this->addSql('DROP INDEX IDX_9A7BD98ED966BF49 ON listings');
        $this->addSql('DROP INDEX IDX_9A7BD98E18F33F75 ON listings');
        $this->addSql('ALTER TABLE listings DROP models_id, DROP sellers_id');
        $this->addSql('ALTER TABLE models DROP FOREIGN KEY FK_E4D63009E9EEC0C7');
        $this->addSql('ALTER TABLE models DROP FOREIGN KEY FK_E4D63009A21214B7');
        $this->addSql('DROP INDEX IDX_E4D63009E9EEC0C7 ON models');
        $this->addSql('DROP INDEX IDX_E4D63009A21214B7 ON models');
        $this->addSql('ALTER TABLE models DROP brands_id, DROP categories_id');
    }
}
