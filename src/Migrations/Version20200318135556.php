<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318135556 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE advert (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, department_id INT DEFAULT NULL, date DATE NOT NULL, updated_at DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, published TINYINT(1) NOT NULL, nb_applications INT NOT NULL, INDEX IDX_54F1F40BF675F31B (author_id), INDEX IDX_54F1F40BAE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advert_category (advert_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_84EEA340D07ECCB6 (advert_id), INDEX IDX_84EEA34012469DE2 (category_id), PRIMARY KEY(advert_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, advert_id INT DEFAULT NULL, author_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_A45BDDC1D07ECCB6 (advert_id), INDEX IDX_A45BDDC1F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, curriculum VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, mode VARCHAR(255) NOT NULL, token VARCHAR(100) DEFAULT NULL, validation TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE advert_category ADD CONSTRAINT FK_84EEA340D07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advert_category ADD CONSTRAINT FK_84EEA34012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1D07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advert_category DROP FOREIGN KEY FK_84EEA340D07ECCB6');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1D07ECCB6');
        $this->addSql('ALTER TABLE advert_category DROP FOREIGN KEY FK_84EEA34012469DE2');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BAE80F5DF');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BF675F31B');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1F675F31B');
        $this->addSql('DROP TABLE advert');
        $this->addSql('DROP TABLE advert_category');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE user');
    }
}
