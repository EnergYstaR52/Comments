<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m210308_204359_add_topic_table
 */
class m210308_204359_add_topic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('topic', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string(),
            'body'       => $this->text(),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()')),
            'updated_at' => $this->dateTime()->defaultValue(new Expression('NOW()'))
        ]);

        $this->addForeignKey(
            'fk_comment_topic_id_topic_id',
            'comment',
            'topic_id',
            'topic',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comment_topic_id_topic_id', 'comment');
        $this->dropTable('topic');
    }
}
