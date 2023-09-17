<?php

use App\Models\UserModel;
use Myth\Auth\Entities\User;


if (!function_exists('system_status')) {
    /**
     * Ensures that the current user has the passed in permission.
     * The permission can be passed in either as an ID or name.
     *
     * @param int|string $permission
     */
    function system_status()
    {
        $authenticate = service('authentication');
        $authorize    = service('authorization');

        if ($authenticate->check()) {
            if ($authorize->inGroup('user', $authenticate->id())) {
                return model(UserModel::class)->where('id', $authenticate->id())->findColumn('status_sistem')[0];
            }
        }

        return false;
    }
}

if (!function_exists('user_email')) {
    /**
     * Returns the User ID for the current logged in user.
     *
     * @return int|null
     */
    function user_email()
    {
        $authenticate = service('authentication');
        $authorize    = service('authorization');

        if ($authenticate->check()) {
            if ($authorize->inGroup('user', $authenticate->id())) {
                return model(UserModel::class)->where('id', $authenticate->id())->findColumn('email')[0];
            }
        }

        return false;
    }
}
