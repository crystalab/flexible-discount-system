<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190113183608 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unit_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D34A04ADF8BD700D ON product (unit_id)');
        $this->addSql('CREATE TABLE product_group (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE group_product (product_group_id INTEGER NOT NULL, product_id INTEGER NOT NULL, PRIMARY KEY(product_group_id, product_id))');
        $this->addSql('CREATE INDEX IDX_554A50A135E4B3D0 ON group_product (product_group_id)');
        $this->addSql('CREATE INDEX IDX_554A50A14584665A ON group_product (product_id)');
        $this->addSql('CREATE TABLE unit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_partible BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE benefit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, discount_id INTEGER DEFAULT NULL, discount_type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FE3C668F4C7C611F ON benefit (discount_id)');
        $this->addSql('CREATE TABLE absolute_discount_benefit (id INTEGER NOT NULL, discount_sum DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE percent_discount_benefit (id INTEGER NOT NULL, discount_percents DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE free_product_benefit (id INTEGER NOT NULL, product_id INTEGER DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30C0F4A14584665A ON free_product_benefit (product_id)');
        $this->addSql('CREATE TABLE discount (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, root_rule_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, is_multipliable BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1E0B40E980F4B9B ON discount (root_rule_id)');
        $this->addSql('CREATE TABLE rule (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rule_type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE count_of_products_of_group_rule (id INTEGER NOT NULL, product_group_id INTEGER DEFAULT NULL, operator VARCHAR(3) NOT NULL, count DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_69E74FB035E4B3D0 ON count_of_products_of_group_rule (product_group_id)');
        $this->addSql('CREATE TABLE count_of_products_rule (id INTEGER NOT NULL, product_id INTEGER DEFAULT NULL, operator VARCHAR(3) NOT NULL, count DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CA1BE1BF4584665A ON count_of_products_rule (product_id)');
        $this->addSql('CREATE TABLE total_count_of_products_rule (id INTEGER NOT NULL, operator VARCHAR(3) NOT NULL, count DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE total_of_cart_rule (id INTEGER NOT NULL, operator VARCHAR(3) NOT NULL, count DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_group');
        $this->addSql('DROP TABLE group_product');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE benefit');
        $this->addSql('DROP TABLE absolute_discount_benefit');
        $this->addSql('DROP TABLE percent_discount_benefit');
        $this->addSql('DROP TABLE free_product_benefit');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE rule');
        $this->addSql('DROP TABLE count_of_products_of_group_rule');
        $this->addSql('DROP TABLE count_of_products_rule');
        $this->addSql('DROP TABLE total_count_of_products_rule');
        $this->addSql('DROP TABLE total_of_cart_rule');
    }
}
