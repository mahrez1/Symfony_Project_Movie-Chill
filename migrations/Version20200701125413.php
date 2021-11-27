<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701125413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE basket_video (basket_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_2ABF91161BE1FB52 (basket_id), INDEX IDX_2ABF911629C1004E (video_id), PRIMARY KEY(basket_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket_video ADD CONSTRAINT FK_2ABF91161BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE basket_video ADD CONSTRAINT FK_2ABF911629C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket_video DROP FOREIGN KEY FK_2ABF91161BE1FB52');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE basket_video');
    }
}
