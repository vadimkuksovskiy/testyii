<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{users}}';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $user = User::find()
            ->where(['id' => $id])
            ->one();

        if ($user->id !== null) {
            return $user;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = User::find()
            ->where(['accessToken' => $token])
            ->one();

        if ($user->id !== null) {
            return $user;
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = User::find()
            ->where(['username' => $username])
            ->one();

        if ($user->id !== null) {
            return $user;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlgorithmResults(): ActiveQuery
    {
        return $this->hasMany(AlgorithmResult::class, ['user_id' => 'id']);
    }
}
