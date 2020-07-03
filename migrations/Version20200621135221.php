<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621135221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE code_barre (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, code VARCHAR(50) NOT NULL, INDEX IDX_3DBB68876702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, titre VARCHAR(50) NOT NULL, auteur VARCHAR(50) NOT NULL, type VARCHAR(50) DEFAULT NULL, editeur VARCHAR(50) DEFAULT NULL, annee DATE NOT NULL, resume VARCHAR(1500) NOT NULL, INDEX IDX_AC634F9979F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON DEFAULT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_naissance DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE code_barre ADD CONSTRAINT FK_3DBB68876702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9979F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE code_barre DROP FOREIGN KEY FK_3DBB68876702C95E');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9979F37AE5');
        $this->addSql('DROP TABLE code_barre');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE user');
    }
}
