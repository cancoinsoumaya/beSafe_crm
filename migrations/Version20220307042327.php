<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307042327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_type_company_contact (contact_type_id INT NOT NULL, company_contact_id INT NOT NULL, INDEX IDX_A68160AF5F63AD12 (contact_type_id), INDEX IDX_A68160AF5A2FCCDC (company_contact_id), PRIMARY KEY(contact_type_id, company_contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_type_indevidual_contact (contact_type_id INT NOT NULL, indevidual_contact_id INT NOT NULL, INDEX IDX_214305575F63AD12 (contact_type_id), INDEX IDX_21430557BF48E35F (indevidual_contact_id), PRIMARY KEY(contact_type_id, indevidual_contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_type_company_contact ADD CONSTRAINT FK_A68160AF5F63AD12 FOREIGN KEY (contact_type_id) REFERENCES contact_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_type_company_contact ADD CONSTRAINT FK_A68160AF5A2FCCDC FOREIGN KEY (company_contact_id) REFERENCES company_contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_type_indevidual_contact ADD CONSTRAINT FK_214305575F63AD12 FOREIGN KEY (contact_type_id) REFERENCES contact_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_type_indevidual_contact ADD CONSTRAINT FK_21430557BF48E35F FOREIGN KEY (indevidual_contact_id) REFERENCES indevidual_contact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_type_company_contact DROP FOREIGN KEY FK_A68160AF5F63AD12');
        $this->addSql('ALTER TABLE contact_type_indevidual_contact DROP FOREIGN KEY FK_214305575F63AD12');
        $this->addSql('DROP TABLE contact_type');
        $this->addSql('DROP TABLE contact_type_company_contact');
        $this->addSql('DROP TABLE contact_type_indevidual_contact');
        $this->addSql('ALTER TABLE company_contact CHANGE name name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE gender gender VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE siren_number siren_number VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE postcode postcode VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE indevidual_contact CHANGE first_name first_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE role role VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone phone VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture picture VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title title VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
