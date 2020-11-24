<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109110840 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre ADD type_contrat_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F520D03A ON offre (type_contrat_id)');
        $this->addSql('ALTER TABLE type_contrat DROP FOREIGN KEY FK_4815F6666C83CD9F');
        $this->addSql('DROP INDEX IDX_4815F6666C83CD9F ON type_contrat');
        $this->addSql('ALTER TABLE type_contrat DROP offres_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F520D03A');
        $this->addSql('DROP INDEX IDX_AF86866F520D03A ON offre');
        $this->addSql('ALTER TABLE offre DROP type_contrat_id');
        $this->addSql('ALTER TABLE type_contrat ADD offres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_contrat ADD CONSTRAINT FK_4815F6666C83CD9F FOREIGN KEY (offres_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_4815F6666C83CD9F ON type_contrat (offres_id)');
    }
}
