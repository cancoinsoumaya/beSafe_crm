<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220309194840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_company_contact (user_id INT NOT NULL, company_contact_id INT NOT NULL, INDEX IDX_7EEC9060A76ED395 (user_id), INDEX IDX_7EEC90605A2FCCDC (company_contact_id), PRIMARY KEY(user_id, company_contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_indevidual_contact (user_id INT NOT NULL, indevidual_contact_id INT NOT NULL, INDEX IDX_9C0F28AAA76ED395 (user_id), INDEX IDX_9C0F28AABF48E35F (indevidual_contact_id), PRIMARY KEY(user_id, indevidual_contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_company_contact ADD CONSTRAINT FK_7EEC9060A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_company_contact ADD CONSTRAINT FK_7EEC90605A2FCCDC FOREIGN KEY (company_contact_id) REFERENCES company_contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_indevidual_contact ADD CONSTRAINT FK_9C0F28AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_indevidual_contact ADD CONSTRAINT FK_9C0F28AABF48E35F FOREIGN KEY (indevidual_contact_id) REFERENCES indevidual_contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BF48E35F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495A2FCCDC');
        $this->addSql('DROP INDEX IDX_8D93D6495A2FCCDC ON user');
        $this->addSql('DROP INDEX IDX_8D93D649BF48E35F ON user');
        $this->addSql('ALTER TABLE user DROP indevidual_contact_id, DROP company_contact_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_company_contact');
        $this->addSql('DROP TABLE user_indevidual_contact');
        $this->addSql('ALTER TABLE company_contact CHANGE name name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE siren_number siren_number VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE postcode postcode VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contact_type CHANGE label label VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE color color VARCHAR(7) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE event CHANGE title title VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE color_event color_event VARCHAR(7) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE indevidual_contact CHANGE first_name first_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE role role VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE team CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD indevidual_contact_id INT DEFAULT NULL, ADD company_contact_id INT DEFAULT NULL, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone phone VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture picture VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title title VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BF48E35F FOREIGN KEY (indevidual_contact_id) REFERENCES indevidual_contact (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495A2FCCDC FOREIGN KEY (company_contact_id) REFERENCES company_contact (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6495A2FCCDC ON user (company_contact_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BF48E35F ON user (indevidual_contact_id)');
    }
}
