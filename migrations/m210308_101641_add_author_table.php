<?php

use yii\db\Migration;

/**
 * Class m210308_101641_add_author_table
 */
class m210308_101641_add_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('author', [
            'id'         => $this->primaryKey(),
            'name'       => $this->string(255)->notNull(),
            'avatar_url' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author');
    }
}
