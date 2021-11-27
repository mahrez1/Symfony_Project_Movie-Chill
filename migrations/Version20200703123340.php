<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200703123340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket_video DROP FOREIGN KEY FK_2ABF91161BE1FB52');
        $this->addSql('ALTER TABLE basket_video DROP FOREIGN KEY FK_2ABF911629C1004E');
        $this->addSql('ALTER TABLE basket_video ADD CONSTRAINT FK_2ABF91161BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('ALTER TABLE basket_video ADD CONSTRAINT FK_2ABF911629C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket_video DROP FOREIGN KEY FK_2ABF91161BE1FB52');
        $this->addSql('ALTER TABLE basket_video DROP FOREIGN KEY FK_2ABF911629C1004E');
        $this->addSql('ALTER TABLE basket_video ADD CONSTRAINT FK_2ABF91161BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE basket_video ADD CONSTRAINT FK_2ABF911629C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
    }
}
