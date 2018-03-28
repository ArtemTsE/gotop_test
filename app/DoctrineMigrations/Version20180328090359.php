<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180328090359 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
            SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
            SET AUTOCOMMIT = 0;
            START TRANSACTION;
            SET time_zone = "+00:00";
        ');

        $this->addSql('
            INSERT INTO `article` (`id`, `title`, `content`) VALUES
            (1, \'An Article\', \'Lorem ipsum dolor sit amet, consetetur sadipscing elitr\'),
            (2, \'Another one\', \'consetetur sadipscing elitr\'),
            (3, \'Here we go again\', \'sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat\'),
            (4, \'And again\', \'At vero eos et accusam et justo duo dolores\'),
            (5, \'This is not the end\', \'Whatever this means.\'),
            (6, \'This is not the beginning\', \'But it may be one day\'),
            (7, \'The end\', \'Sadly its over\');
        ');

        $this->addSql('
            INSERT INTO `comment` (`id`, `article_id`, `title`, `content`) VALUES
            (1, 1, \'First\', \'This is the first comment!\'),
            (2, 1, \'Damn\', \'Second comment for this aritcle\'),
            (3, 3, \'Just for fun\', \'I dont know what I was thinking...\'),
            (4, 4, \'Lorem what\', \'I wonder who reads this.\'),
            (5, 7, \'Good buy\', \'Hope to see you soon\');
        ');

        $this->addSql('COMMIT;');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
            SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
            SET AUTOCOMMIT = 0;
            START TRANSACTION;
            SET time_zone = "+00:00";
            SET FOREIGN_KEY_CHECKS = 0;
        ');

        $this->addSql('TRUNCATE TABLE comment');
        $this->addSql('TRUNCATE TABLE article');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 1;');

        $this->addSql('COMMIT;');
    }
}
