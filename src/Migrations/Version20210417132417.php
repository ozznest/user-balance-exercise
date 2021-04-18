<?php

declare(strict_types=1);

namespace User\Balance\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210417132417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE user_balance ADD CONSTRAINT FK_F4F901F4C69D3FB FOREIGN KEY (usr_id) REFERENCES user (id)');
        //$this->addSql('ALTER TABLE user DROP balance, CHANGE status status TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_balance ADD CONSTRAINT FK_F4F901F4C69D3FB FOREIGN KEY (usr_id) REFERENCES user (id)');
        $this->addSql('insert into user_balance.user_balance(usr_id, balance) select id, balance from user');
        $this->addSql('ALTER TABLE user DROP balance, CHANGE status status TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('delete from user_balance');
    }
}
