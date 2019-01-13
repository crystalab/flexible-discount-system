<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190113183624 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO unit (id, name, is_partible) VALUES (1, 'piece', 0), (2, 'kg', 1)");
        $this->addSql(
            "INSERT INTO product (id, unit_id, name, price) VALUES " .
            "(1, 1, 'Pineapple', 1.30), " .
            "(2, 1, 'Watermelon', 0.8), " .
            "(3, 2, 'Tomoto', 1.4), " .
            "(4, 2, 'Apple', 0.6), " .
            "(5, 2, 'Cucumber', 0.7)"
        );

        $this->addSql("INSERT INTO product_group (id, name) VALUES (1, 'Fruits'), (2, 'Vegetables')");

        $this->addSql("INSERT INTO group_product (product_id, product_group_id) VALUES " .
            "(1, 1), " .
            "(2, 1), " .
            "(3, 2), " .
            "(4, 1), " .
            "(5, 2)"
        );

        // buy 3 pineapple for 3.00 (6 for 6.00, etc.)
        $this->addSql("INSERT INTO rule (id, rule_type) VALUES (1, 'count_of_products_rule')");
        $this->addSql("INSERT INTO count_of_products_rule (id, product_id, operator, count) VALUES (1, 1, '>=', 3)");
        $this->addSql("INSERT INTO discount (id, root_rule_id, name, is_multipliable) VALUES (1, 1, '3 for 3', 1)");
        $this->addSql("INSERT INTO benefit (id, discount_id, discount_type) VALUES (1, 1, 'absolute_discount_benefit')");
        $this->addSql("INSERT INTO absolute_discount_benefit (id, discount_sum) VALUES (1, 0.90)");

        // buy 2 watermelons get one for free
        $this->addSql("INSERT INTO rule (id, rule_type) VALUES (2, 'count_of_products_rule')");
        $this->addSql("INSERT INTO count_of_products_rule (id, product_id, operator, count) VALUES (2, 2, '>=', 2)");
        $this->addSql("INSERT INTO discount (id, root_rule_id, name, is_multipliable) VALUES (2, 2, 'buy two, get one free', 1)");
        $this->addSql("INSERT INTO benefit (id, discount_id, discount_type) VALUES (2, 2, 'free_product_benefit')");
        $this->addSql("INSERT INTO free_product_benefit (id, product_id, amount) VALUES (1, 2, 1)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
