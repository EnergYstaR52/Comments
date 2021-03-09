<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "topic".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $body
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Comment[] $comments
 */
class Topic extends ActiveRecord
{
    public static function tableName() : string
    {
        return 'topic';
    }

    public function rules() : array
    {
        return [
            [['body'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getComments() : ActiveQuery
    {
        return $this->hasMany(Comment::className(), ['topic_id' => 'id']);
    }
}