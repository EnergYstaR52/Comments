<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m210307_223400_add_comment_table
 */
class m210307_223400_add_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id'         => $this->primaryKey(),
            'parent_id'  => $this->integer(11)->defaultValue(0),
            'topic_id'   => $this->integer(11),
            'body'       => $this->text(),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comment');
    }

}
