<?php
/**
 * Created by PhpStorm.
 * User: vecherskyy
 * Date: 01.11.16
 * Time: 19:31
 */

namespace app\models;


use yii\base\Model;
use Yii;

class RegForm extends Model
{
    public $username;
    public $password;
    public $rememberMe;


    public function rules()
    {
        return [
            [['password', 'username'],'filter', 'filter' => 'trim'],
            [['password', 'username'],'required'],

            [['password', 'username'], 'string', 'min' => 2, 'max' => 255],

            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'Этото username уже занят.'],

        ];
    }


    public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }


}