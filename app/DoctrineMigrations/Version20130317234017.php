<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130317234017 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE geoareas DROP FOREIGN KEY FK_1B2ED47727ACA70");
        $this->addSql("DROP TABLE geoareas");
        $this->addSql("ALTER TABLE User ADD updatedAt DATETIME DEFAULT NULL, ADD credentialsExpireAt DATETIME DEFAULT NULL, ADD lastLoginAt DATETIME DEFAULT NULL, ADD confirmationToken VARCHAR(255) NOT NULL, ADD credentialsExpired TINYINT(1) NOT NULL, ADD expired TINYINT(1) NOT NULL, DROP updated_at, DROP last_login_at, CHANGE created_at createdAt DATETIME NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE geoareas (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(128) DEFAULT NULL, latitude NUMERIC(10, 0) DEFAULT NULL, longitude NUMERIC(10, 0) DEFAULT NULL, lft INT NOT NULL, rgt INT NOT NULL, root INT DEFAULT NULL, level INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1B2ED47989D9B62 (slug), INDEX IDX_1B2ED47727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE geoareas ADD CONSTRAINT FK_1B2ED47727ACA70 FOREIGN KEY (parent_id) REFERENCES geoareas (id) ON DELETE SET NULL");
        $this->addSql("ALTER TABLE User ADD updated_at DATETIME DEFAULT NULL, ADD last_login_at DATETIME DEFAULT NULL, DROP updatedAt, DROP credentialsExpireAt, DROP lastLoginAt, DROP confirmationToken, DROP credentialsExpired, DROP expired, CHANGE createdat created_at DATETIME NOT NULL");
    }
}
