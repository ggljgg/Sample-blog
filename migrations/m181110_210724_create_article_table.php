<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m181110_210724_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'content' => $this->text(),
            'date' => $this->date(),
            'image' => $this->string(),
            'viewed' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->integer(),
            'category_id' => $this->integer()
        ]);

        // creating index for column `user_id`
        $this->createIndex(
            'idx-article-user_id',
            'article',
            'user_id'
        );

        // adding foreign key for table `user`
        $this->addForeignKey(
            'fk-article-user_id',
            'article',
            'user_id',
            'user',
            'id',
            'RESTRICT'
        );

        // creating index for column `category_id`
        $this->createIndex(
            'idx-article-category_id',
            'article',
            'category_id'
        );

        // adding foreign key for table `category`
        $this->addForeignKey(
            'fk-article-category_id',
            'article',
            'category_id',
            'category',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // droping foreign key for table `article`
        $this->dropForeignKey(
            'fk-article-user_id',
            'article'
        );

        // dropping index for column `user_id`
        $this->dropIndex(
            'idx-article-user_id',
            'article'
        );

        // droping foreign key for table `article`
        $this->dropForeignKey(
            'fk-article-category_id',
            'article'
        );

        // dropping index for column `category_id`
        $this->dropIndex(
            'idx-article-category_id',
            'article'
        );

        $this->dropTable('article');
    }
}
