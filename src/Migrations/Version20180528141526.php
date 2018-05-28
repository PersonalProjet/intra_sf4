<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180528141526 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, firstname VARCHAR(25) NOT NULL, secondname VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D64983A00E68 (firstname), UNIQUE INDEX UNIQ_8D93D649EAB117EF (secondname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_banque (user_id INT NOT NULL, banque_id INT NOT NULL, INDEX IDX_D4A4D001A76ED395 (user_id), INDEX IDX_D4A4D00137E080D9 (banque_id), PRIMARY KEY(user_id, banque_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prelevement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banque (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, banque_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_CFF6526037E080D9 (banque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_banque ADD CONSTRAINT FK_D4A4D001A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_banque ADD CONSTRAINT FK_D4A4D00137E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526037E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_banque DROP FOREIGN KEY FK_D4A4D001A76ED395');
        $this->addSql('ALTER TABLE user_banque DROP FOREIGN KEY FK_D4A4D00137E080D9');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526037E080D9');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_banque');
        $this->addSql('DROP TABLE prelevement');
        $this->addSql('DROP TABLE banque');
        $this->addSql('DROP TABLE compte');
    }
}
