<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018092537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pnj (id INT AUTO_INCREMENT NOT NULL, shardid_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, honor INT NOT NULL, INDEX IDX_FDA97F2D54FA3070 (shardid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pnj_data (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, time VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pnj_data_pnj (pnj_data_id INT NOT NULL, pnj_id INT NOT NULL, INDEX IDX_EA14A14AB55943CE (pnj_data_id), INDEX IDX_EA14A14A51796E0B (pnj_id), PRIMARY KEY(pnj_data_id, pnj_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shard (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9801ADCCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, inscription_date DATETIME NOT NULL, last_conection DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pnj ADD CONSTRAINT FK_FDA97F2D54FA3070 FOREIGN KEY (shardid_id) REFERENCES shard (id)');
        $this->addSql('ALTER TABLE pnj_data_pnj ADD CONSTRAINT FK_EA14A14AB55943CE FOREIGN KEY (pnj_data_id) REFERENCES pnj_data (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pnj_data_pnj ADD CONSTRAINT FK_EA14A14A51796E0B FOREIGN KEY (pnj_id) REFERENCES pnj (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shard ADD CONSTRAINT FK_9801ADCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pnj DROP FOREIGN KEY FK_FDA97F2D54FA3070');
        $this->addSql('ALTER TABLE pnj_data_pnj DROP FOREIGN KEY FK_EA14A14AB55943CE');
        $this->addSql('ALTER TABLE pnj_data_pnj DROP FOREIGN KEY FK_EA14A14A51796E0B');
        $this->addSql('ALTER TABLE shard DROP FOREIGN KEY FK_9801ADCCA76ED395');
        $this->addSql('DROP TABLE pnj');
        $this->addSql('DROP TABLE pnj_data');
        $this->addSql('DROP TABLE pnj_data_pnj');
        $this->addSql('DROP TABLE shard');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
