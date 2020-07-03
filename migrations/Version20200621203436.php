<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621203436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, avis_text VARCHAR(2000) NOT NULL, note INT NOT NULL, auteur_nom VARCHAR(50) NOT NULL, auteur_prenom VARCHAR(50) NOT NULL, INDEX IDX_8F91ABF06702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citation (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, auteur VARCHAR(50) NOT NULL, text VARCHAR(2000) NOT NULL, rapporteur_nom VARCHAR(50) NOT NULL, rapporteur_prenom VARCHAR(50) NOT NULL, INDEX IDX_FABD9C7E6702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conseil (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, conseil_text VARCHAR(2000) NOT NULL, rapporteur_nom VARCHAR(50) NOT NULL, rapporteur_prenom VARCHAR(50) NOT NULL, INDEX IDX_3F3F06816702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, intitule VARCHAR(50) NOT NULL, type VARCHAR(50) NOT NULL, auteur_nom VARCHAR(50) NOT NULL, auteur_prenom VARCHAR(50) NOT NULL, fichier LONGBLOB NOT NULL, INDEX IDX_D8698A766702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, intitule VARCHAR(50) NOT NULL, description VARCHAR(1000) NOT NULL, date DATETIME NOT NULL, rappoteur_nom VARCHAR(50) NOT NULL, rapporteur_prenom VARCHAR(50) NOT NULL, lien VARCHAR(500) DEFAULT NULL, INDEX IDX_B26681E6702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, intitule VARCHAR(300) NOT NULL, realisateur VARCHAR(50) DEFAULT NULL, resume VARCHAR(2000) NOT NULL, annee DATE NOT NULL, rapporteur_nom VARCHAR(50) NOT NULL, rapporteur_prenom VARCHAR(50) NOT NULL, INDEX IDX_8244BE226702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, nom VARCHAR(200) NOT NULL, image LONGBLOB NOT NULL, auteur_nom VARCHAR(50) NOT NULL, auteur_prenom VARCHAR(50) NOT NULL, INDEX IDX_C53D045F6702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, auteur_nom VARCHAR(50) NOT NULL, auteur_prenom VARCHAR(50) NOT NULL, mail VARCHAR(100) NOT NULL, question VARCHAR(2000) NOT NULL, INDEX IDX_B6F7494E6702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, id_question_id INT NOT NULL, auteur_nom VARCHAR(50) NOT NULL, auteur_prenom VARCHAR(50) NOT NULL, mail VARCHAR(100) NOT NULL, reponse VARCHAR(2000) NOT NULL, INDEX IDX_5FB6DEC76702C95E (id_livre_id), INDEX IDX_5FB6DEC76353B48 (id_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE son (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, nom VARCHAR(50) NOT NULL, son LONGBLOB NOT NULL, auteur_nom VARCHAR(50) NOT NULL, auteur_prenom VARCHAR(50) NOT NULL, description VARCHAR(200) DEFAULT NULL, INDEX IDX_E199342C6702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF06702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE citation ADD CONSTRAINT FK_FABD9C7E6702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE conseil ADD CONSTRAINT FK_3F3F06816702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A766702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E6702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE226702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F6702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E6702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE son ADD CONSTRAINT FK_E199342C6702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC76353B48');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE citation');
        $this->addSql('DROP TABLE conseil');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE son');
    }
}
