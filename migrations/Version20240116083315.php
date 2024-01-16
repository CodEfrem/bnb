<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240116083315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, traveler_id INT NOT NULL, review_id INT DEFAULT NULL, room_id INT NOT NULL, user_id INT NOT NULL, number VARCHAR(50) NOT NULL, check_in DATETIME NOT NULL, check_out DATETIME NOT NULL, occupants INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_E00CEDDE59BBE8A3 (traveler_id), UNIQUE INDEX UNIQ_E00CEDDE3E2E969B (review_id), INDEX IDX_E00CEDDE54177093 (room_id), INDEX IDX_E00CEDDEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment_room (equipment_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_481B809D517FE9FE (equipment_id), INDEX IDX_481B809D54177093 (room_id), PRIMARY KEY(equipment_id, room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, traveler_id INT NOT NULL, rooms_id INT NOT NULL, title VARCHAR(50) NOT NULL, comment LONGTEXT NOT NULL, rating INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_794381C659BBE8A3 (traveler_id), INDEX IDX_794381C68E2368AB (rooms_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE59BBE8A3 FOREIGN KEY (traveler_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE equipment_room ADD CONSTRAINT FK_481B809D517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment_room ADD CONSTRAINT FK_481B809D54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C659BBE8A3 FOREIGN KEY (traveler_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C68E2368AB FOREIGN KEY (rooms_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE59BBE8A3');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE3E2E969B');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE54177093');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE equipment_room DROP FOREIGN KEY FK_481B809D517FE9FE');
        $this->addSql('ALTER TABLE equipment_room DROP FOREIGN KEY FK_481B809D54177093');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C659BBE8A3');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C68E2368AB');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE equipment_room');
        $this->addSql('DROP TABLE review');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
