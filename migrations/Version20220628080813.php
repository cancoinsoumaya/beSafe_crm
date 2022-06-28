<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628080813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, siren_number VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone_number VARCHAR(20) NOT NULL, postcode VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) NOT NULL, city VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_6C30FCEFD07E39B8 (siren_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_type_company_contact (contact_type_id INT NOT NULL, company_contact_id INT NOT NULL, INDEX IDX_A68160AF5F63AD12 (contact_type_id), INDEX IDX_A68160AF5A2FCCDC (company_contact_id), PRIMARY KEY(contact_type_id, company_contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_type_indevidual_contact (contact_type_id INT NOT NULL, indevidual_contact_id INT NOT NULL, INDEX IDX_214305575F63AD12 (contact_type_id), INDEX IDX_21430557BF48E35F (indevidual_contact_id), PRIMARY KEY(contact_type_id, indevidual_contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, all_day TINYINT(1) NOT NULL, color_event VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indevidual_contact (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, role VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone_number VARCHAR(20) NOT NULL, created_at DATETIME DEFAULT \'2022-01-01 00:00:00\' NOT NULL, UNIQUE INDEX UNIQ_304BCE51E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, phone VARCHAR(20) NOT NULL, picture VARCHAR(100) DEFAULT NULL, title VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_event (user_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_D96CF1FFA76ED395 (user_id), INDEX IDX_D96CF1FF71F7E88B (event_id), PRIMARY KEY(user_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_company_contact (user_id INT NOT NULL, company_contact_id INT NOT NULL, INDEX IDX_7EEC9060A76ED395 (user_id), INDEX IDX_7EEC90605A2FCCDC (company_contact_id), PRIMARY KEY(user_id, company_contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_indevidual_contact (user_id INT NOT NULL, indevidual_contact_id INT NOT NULL, INDEX IDX_9C0F28AAA76ED395 (user_id), INDEX IDX_9C0F28AABF48E35F (indevidual_contact_id), PRIMARY KEY(user_id, indevidual_contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_type_company_contact ADD CONSTRAINT FK_A68160AF5F63AD12 FOREIGN KEY (contact_type_id) REFERENCES contact_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_type_company_contact ADD CONSTRAINT FK_A68160AF5A2FCCDC FOREIGN KEY (company_contact_id) REFERENCES company_contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_type_indevidual_contact ADD CONSTRAINT FK_214305575F63AD12 FOREIGN KEY (contact_type_id) REFERENCES contact_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_type_indevidual_contact ADD CONSTRAINT FK_21430557BF48E35F FOREIGN KEY (indevidual_contact_id) REFERENCES indevidual_contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FF71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_company_contact ADD CONSTRAINT FK_7EEC9060A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_company_contact ADD CONSTRAINT FK_7EEC90605A2FCCDC FOREIGN KEY (company_contact_id) REFERENCES company_contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_indevidual_contact ADD CONSTRAINT FK_9C0F28AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_indevidual_contact ADD CONSTRAINT FK_9C0F28AABF48E35F FOREIGN KEY (indevidual_contact_id) REFERENCES indevidual_contact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_type_company_contact DROP FOREIGN KEY FK_A68160AF5A2FCCDC');
        $this->addSql('ALTER TABLE user_company_contact DROP FOREIGN KEY FK_7EEC90605A2FCCDC');
        $this->addSql('ALTER TABLE contact_type_company_contact DROP FOREIGN KEY FK_A68160AF5F63AD12');
        $this->addSql('ALTER TABLE contact_type_indevidual_contact DROP FOREIGN KEY FK_214305575F63AD12');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FF71F7E88B');
        $this->addSql('ALTER TABLE contact_type_indevidual_contact DROP FOREIGN KEY FK_21430557BF48E35F');
        $this->addSql('ALTER TABLE user_indevidual_contact DROP FOREIGN KEY FK_9C0F28AABF48E35F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649296CD8AE');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FFA76ED395');
        $this->addSql('ALTER TABLE user_company_contact DROP FOREIGN KEY FK_7EEC9060A76ED395');
        $this->addSql('ALTER TABLE user_indevidual_contact DROP FOREIGN KEY FK_9C0F28AAA76ED395');
        $this->addSql('DROP TABLE company_contact');
        $this->addSql('DROP TABLE contact_type');
        $this->addSql('DROP TABLE contact_type_company_contact');
        $this->addSql('DROP TABLE contact_type_indevidual_contact');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE indevidual_contact');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_event');
        $this->addSql('DROP TABLE user_company_contact');
        $this->addSql('DROP TABLE user_indevidual_contact');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
