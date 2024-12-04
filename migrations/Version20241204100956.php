<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
final class Version20241204100956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brands (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cars (id SERIAL NOT NULL, brand_id INT NOT NULL, model_id INT NOT NULL, photo VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE models (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_95C71D1444F5D008 ON cars (brand_id)');
        $this->addSql('CREATE INDEX IDX_95C71D147975B7E7 ON cars (model_id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1444F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D147975B7E7 FOREIGN KEY (model_id) REFERENCES models (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        // Добавление записей в таблицу brands
        $this->addSql("INSERT INTO brands (name) VALUES ('Toyota')");
        $this->addSql("INSERT INTO brands (name) VALUES ('Ford')");
        $this->addSql("INSERT INTO brands (name) VALUES ('Honda')");

        // Добавление записей в таблицу models
        $this->addSql("INSERT INTO models (name) VALUES ('Camry')");
        $this->addSql("INSERT INTO models (name) VALUES ('Mustang')");
        $this->addSql("INSERT INTO models (name) VALUES ('Civic')");

        // Добавление записей в таблицу cars
        $this->addSql("INSERT INTO cars (brand_id, model_id, photo, price) VALUES (1, 1, 'path/to/photo1.jpg', 20000)");
        $this->addSql("INSERT INTO cars (brand_id, model_id, photo, price) VALUES (2, 2, 'path/to/photo2.jpg', 25000)");
        $this->addSql("INSERT INTO cars (brand_id, model_id, photo, price) VALUES (3, 3, 'path/to/photo3.jpg', 22000)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cars DROP CONSTRAINT FK_95C71D1444F5D008');
        $this->addSql('ALTER TABLE cars DROP CONSTRAINT FK_95C71D147975B7E7');
        $this->addSql('DROP TABLE brands');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE models');
    }
}
