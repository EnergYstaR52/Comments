<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 * @property string|null $avatar_url
 *
 * @property Comment[] $comments
 */
class Author extends ActiveRecord
{
    public static function tableName() : string
    {
        return 'author';
    }

    public function rules() : array
    {
        return [
            [['name'], 'required'],
            [['name', 'avatar_url'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'avatar_url' => 'Avatar Url',
        ];
    }

    public function getComments() : ActiveQuery
    {
        return $this->hasMany(Comment::class, ['author_id' => 'id']);
    }
}