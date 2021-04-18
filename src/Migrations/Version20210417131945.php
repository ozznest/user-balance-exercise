<?php

declare(strict_types=1);

namespace User\Balance\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210417131945 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_balance (id INT AUTO_INCREMENT NOT NULL, usr_id INT DEFAULT NULL, balance DOUBLE PRECISION DEFAULT \'0.00\', UNIQUE INDEX UNIQ_F4F901F4C69D3FB (usr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE user DROP balance, CHANGE status status TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_balance');
        //$this->addSql('ALTER TABLE user ADD balance DOUBLE PRECISION DEFAULT \'0\', CHANGE status status TINYINT(1) DEFAULT \'0\'');
    }
}
