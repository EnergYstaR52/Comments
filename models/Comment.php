<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $topic_id
 * @property string|null $body
 * @property string|null $created_at
 * @property Author $author
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'topic_id'], 'integer'],
            [['body'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'parent_id'  => 'Parent ID',
            'topic_id'   => 'Topic ID',
            'body'       => 'Body',
            'created_at' => 'Created At',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}