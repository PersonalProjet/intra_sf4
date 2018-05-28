<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180411153013 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_banque DROP FOREIGN KEY FK_D4A4D00137E080D9');
        $this->addSql('ALTER TABLE user_banque DROP FOREIGN KEY FK_D4A4D001A76ED395');
        $this->addSql('ALTER TABLE user_banque DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_banque ADD CONSTRAINT FK_D4A4D00137E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_banque ADD CONSTRAINT FK_D4A4D001A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_banque ADD PRIMARY KEY (banque_id, user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_banque DROP FOREIGN KEY FK_D4A4D00137E080D9');
        $this->addSql('ALTER TABLE user_banque DROP FOREIGN KEY FK_D4A4D001A76ED395');
        $this->addSql('ALTER TABLE user_banque DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_banque ADD CONSTRAINT FK_D4A4D00137E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id)');
        $this->addSql('ALTER TABLE user_banque ADD CONSTRAINT FK_D4A4D001A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_banque ADD PRIMARY KEY (user_id, banque_id)');
    }
}
