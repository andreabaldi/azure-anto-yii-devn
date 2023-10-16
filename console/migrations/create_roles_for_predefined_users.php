<?php

use common\models\User;
use yii\db\Schema;
use yii\db\Migration;

class create_roles_for_predefined_users extends Migration
{
    public function up()
    {
        $rbac = Yii::$app->authManager;

        $guest = $rbac->createRole('guest');
        $guest->description = 'Nobody';
        $rbac->add($guest);

        $user = $rbac->createRole('user');
        $user->description = 'Can use the query UI';
        $rbac->add($user);

        $admin = $rbac->createRole('admin');
        $admin->description = 'Can do anything including managing users';
        $rbac->add($admin);

        $rbac->addChild($admin, $user);
        $rbac->addChild($user, $guest);

        $rbac->assign(
            $user,
            User::findOne(['username' => 'test'])->id
        );
        $rbac->assign(
            $admin,
            User::findOne(['username' => 'admin'])->id
        );
    }

    public function down()
    {
        $manager = Yii::$app->authManager;
        $manager->removeAll();
    }

}