<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m181110_210806_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);

        // creating index for column `article_id`
        $this->createIndex(
            'idx-article_tag-article_id',
            'article_tag',
            'article_id'
        );

        // adding foreign key for table `article`
        $this->addForeignKey(
            'fk-article_tag-article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        // creating index for column `tag_id`
        $this->createIndex(
            'idx-article_tag-tag_id',
            'article_tag',
            'tag_id'
        );

        // adding foreign key for table `tag`
        $this->addForeignKey(
            'fk-article_tag-tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // dropping foreign key for table `article`
        $this->dropForeignKey(
            'fk-article_tag-article_id',
            'article_tag'
        );

        // dropping index for column `article_id`
        $this->dropIndex(
            'idx-article_tag-article_id',
            'article_tag'
        );

        // dropping foreign key for table `tag`
        $this->dropForeignKey(
            'fk-article_tag-tag_id',
            'article_tag'
        );

        // dropping index for column `tag_id`
        $this->dropIndex(
            'idx-article_tag-tag_id',
            'article_tag'
        );

        $this->dropTable('article_tag');
    }
}
