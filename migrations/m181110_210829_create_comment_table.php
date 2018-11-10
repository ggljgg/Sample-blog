<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m181110_210829_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
            'status' => $this->integer()
        ]);

        // creating index for column `user_id`
        $this->createIndex(
            'idx-comment-user_id',
            'comment',
            'user_id'
        );

        // adding foreign key for table `user`
        $this->addForeignKey(
            'fk-comment-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creating index for column `article_id`
        $this->createIndex(
            'idx-comment-article_id',
            'comment',
            'article_id'
        );

        // adding foreign key for table `article`
        $this->addForeignKey(
            'fk-comment-article_id',
            'comment',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // droping foreign key for table `user`
        $this->dropForeignKey(
            'fk-comment-user_id',
            'comment'
        );

        // droping index for column `user_id`
        $this->dropIndex(
            'idx-comment-user_id',
            'comment'
        );

        // droping foreign key for table `article`
        $this->dropForeignKey(
            'fk-comment-article_id',
            'comment'
        );

        // droping index for column `article_id`
        $this->dropIndex(
            'idx-comment-article_id',
            'comment'
        );

        $this->dropTable('comment');
    }
}
