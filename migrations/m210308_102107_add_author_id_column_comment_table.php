<?php

use yii\db\Migration;

/**
 * Class m210308_102107_add_author_id_column_comment_table
 */
class m210308_102107_add_author_id_column_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comment', 'author_id', $this->integer(11));

        $this->addForeignKey(
            'fk_comment_author_id_author_id',
            'comment',
            'author_id',
            'author',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comment_author_id_author_id', 'comment');
        $this->dropColumn('comment', 'author_id');
    }
}
