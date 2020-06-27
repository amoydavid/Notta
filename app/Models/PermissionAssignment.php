<?php

namespace App\Models;


class PermissionAssignment extends BaseModel
{
    //

    /**
     * 判断用户是否有权限
     * @param $user
     * @param $resource
     * @return bool
     */
    public static function valid($user, $resource)
    {
        $Permission = PermissionAssignment::query()->where([
            'user_type' => get_class($user),
            'user_id'=>$user->id,
            'resource_type'=>get_class($resource),
            'resource_id' => $resource->id
        ]);
        return $Permission?true:false;
    }
}
