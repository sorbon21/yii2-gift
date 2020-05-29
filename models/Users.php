<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $fio
 * @property string|null $login
 * @property string $password
 * @property int|null $isActive
 * @property int $postcode
 * @property int|null $yandex_money
 * @property string $phone
 * @property string|null $address
 * @property string $dt
 *
 * @property UserItems[] $userItems
 * @property UsersLoyalityPoint[] $usersLoyalityPoints
 * @property UsersMoney[] $usersMoneys
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'password', 'postcode', 'phone'], 'required'],
            [['isActive', 'postcode', 'yandex_money'], 'integer'],
            [['dt'], 'safe'],
            [['fio'], 'string', 'max' => 50],
            [['login'], 'string', 'max' => 20],
            [['password', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '#',
            'fio' => 'ФИО',
            'login' => 'Логин',
            'password' => 'Пароль',
            'isActive' => 'Активный',
            'postcode' => 'Почтовый индекс',
            'yandex_money' => 'Номер кошелька',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'dt' => 'Дата регистрации',
        ];
    }

    /**
     * Gets query for [[UserItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserItems()
    {
        return $this->hasMany(UserItems::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UsersLoyalityPoints]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersLoyalityPoints()
    {
        return $this->hasMany(UsersLoyalityPoint::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UsersMoneys]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersMoneys()
    {
        return $this->hasMany(UsersMoney::className(), ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return Users::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }
    public function validatePassword($password)
    {
        return $this->password==sha1($password);
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
