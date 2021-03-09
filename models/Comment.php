<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class Comment extends ActiveRecord
{
    public static function tableName() : string
    {
        return 'comment';
    }

    public function rules() : array
    {
        return [
            [['parent_id', 'topic_id'], 'integer'],
            [['body'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'id'         => 'ID',
            'parent_id'  => 'Parent ID',
            'topic_id'   => 'Topic ID',
            'body'       => 'Body',
            'created_at' => 'Created At',
        ];
    }

    public function getAuthor() : ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}