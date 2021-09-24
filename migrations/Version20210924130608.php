<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210924130608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE notation');
        $this->addSql('ALTER TABLE menu CHANGE chief_id chief_id INT NOT NULL');
        $this->addSql('ALTER TABLE notice CHANGE consumer_id consumer_id INT NOT NULL, CHANGE chief_id chief_id INT NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE chief_id chief_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD phone VARCHAR(32) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notation (id INT AUTO_INCREMENT NOT NULL, consumer_id INT DEFAULT NULL, product_id INT DEFAULT NULL, stars INT NOT NULL, INDEX IDX_268BC954584665A (product_id), INDEX IDX_268BC9537FDBD6D (consumer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE notation ADD CONSTRAINT FK_268BC9537FDBD6D FOREIGN KEY (consumer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notation ADD CONSTRAINT FK_268BC954584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE menu CHANGE chief_id chief_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notice CHANGE consumer_id consumer_id INT DEFAULT NULL, CHANGE chief_id chief_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE chief_id chief_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP phone');
    }
}
