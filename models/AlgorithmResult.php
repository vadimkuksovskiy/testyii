<?php

namespace app\models;

use yii\db\ActiveRecord;

class AlgorithmResult extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{algorithm_results}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
