<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510115446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL)');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER NOT NULL, user_id INTEGER NOT NULL, text CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_9474526C7294869C ON comment (article_id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');

        $this->addFakeData();
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE comment');
    }

    private function addFakeData()
    {
        $this->addFakeUsers();
        $this->addFakeArticles();
    }

    private function addFakeUsers(): void
    {
        for ($i = 1; $i <= 10000; $i++) {
            $user = sprintf('user%d', $i);
            $this->addSql('INSERT INTO user(username, email) VALUES (:username, :email)', [
                'username' => $user,
                'email' => sprintf('%s@catenamedia.com', $user),
            ]);
        }
    }

    private function addFakeArticles(): void
    {
        for ($i = 1; $i <= 10000; $i++) {
            $this->addSql('INSERT INTO article(title, content) VALUES (:title, :content)', [
                'title' => sprintf('Article title %d', $i),
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In pulvinar lacus accumsan porta volutpat. Maecenas a aliquet dui. In hac habitasse platea dictumst. Phasellus enim enim, fermentum quis sodales sit amet, tempus ac ex. Curabitur est quam, convallis quis ante et, blandit accumsan enim. Duis id pulvinar ipsum. In et posuere eros. Pellentesque quis urna tincidunt, pulvinar urna vitae, scelerisque felis. Nunc tristique mi augue, non placerat erat eleifend sit amet. Nulla gravida semper nibh et laoreet.
            
                              Quisque egestas dolor ante, quis scelerisque est faucibus semper. Nulla nec dolor est. In ultrices laoreet malesuada. Aenean maximus diam eget auctor facilisis. Mauris in urna nisi. Suspendisse quis nunc nisl. Donec congue, lacus nec aliquam tincidunt, turpis est lacinia leo, vitae condimentum ex odio ut turpis. Aenean feugiat ac purus sit amet facilisis. Sed vulputate ante at magna tempor, vel pulvinar quam auctor. Praesent interdum id lacus vitae tincidunt. Aenean lobortis, nibh vitae facilisis placerat, odio dui volutpat dui, a pellentesque quam nisl sit amet purus. Aliquam commodo dolor quis auctor posuere. Fusce imperdiet feugiat molestie. Nulla vehicula, sapien et elementum condimentum, urna nisi feugiat tellus, quis sodales turpis felis et nibh.'
            ]);
            $this->addFakeComments($i);
        }
    }

    private function addFakeComments($j): void
    {
        for ($i = 1; $i <= mt_rand(50, 100); $i++) {
            $this->addSql('INSERT INTO comment(text, article_id, user_id) VALUES (:text, :article_id, :user_id)', [
                'article_id' => $j,
                'user_id' => mt_rand(1, 10000),
                'text' => 'Nullam condimentum nunc turpis, ut finibus ante fermentum vitae. In maximus malesuada velit sit amet pulvinar. Vivamus hendrerit massa libero. Nullam posuere nunc neque, non posuere sapien feugiat nec. Proin sed aliquam magna. Cras purus dolor, tempus eget condimentum sed, fermentum sed velit. Fusce non pulvinar eros, vel placerat magna.'
            ]);
        }
    }
}
