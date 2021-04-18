<?php

declare(strict_types=1);

namespace User\Balance\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416075415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("insert into user_balance.user (name, email, gender, address, balance, status)
values
('test 1','test1@email.com',1,'test address 1',5,1),
('test 2','test2@email.com',2,'test address 2',50,1),
('test 3','test3@email.com',1,'test address 3',100,2),
('test 4','test4@email.com',1,'test address 4',5,1),
('test 5','test5@email.com',2,'test address 5',50,1),
('test 6','test6@email.com',1,'test address 6',100,2);");

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('delete from user_balance');
    }
}
