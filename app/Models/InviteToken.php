<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

class InviteToken extends BaseModel
{
    const STATUS_NORMAL = 0;
    const STATUS_USED = 1;

    protected $fillable = [
        'token', 'invite_uid', 'expired_at', 'resource_type', 'resource_id', 'status',
    ];


    /**
     * @param User $User
     * @param BaseModel $Object
     * @return self
     */
    public static function buildToken($User, $Object)
    {
        $token = Uuid::uuid1()->toString();
        return self::create([
            'token' => $token,
            'invite_uid' => $User->id,
            'expired_at' => date('Y-m-d H:i:s', strtotime('+24 hours')),
            'resource_type' => get_class($Object),
            'resource_id' => $Object->getAttribute('id'),
            'status' => self::STATUS_NORMAL
        ]);
    }

    public static function valid($token)
    {
        $Model = self::query()->where(['token'=>$token])->first();
        return ($Model && $Model->status == self::STATUS_NORMAL &&strtotime($Model->expired_at) >= time())?$Model:false;
    }

    /**
     * @param User $User
     * @return bool
     */
    public function setUsed($User)
    {
        return \DB::transaction(function() use($User){
            $this->accept_uid = $User->id;
            $this->used_at = date('Y-m-d H:i:s');
            $this->status = self::STATUS_USED;
            if($this->save()) {
                $PermissionAssignment = new PermissionAssignment();
                $PermissionAssignment->user_type = get_class($User);
                $PermissionAssignment->user_id = $User->id;
                $PermissionAssignment->resource_type = $this->resource_type;
                $PermissionAssignment->resource_id = $this->resource_id;
                return $PermissionAssignment->save();
            }
            return false;
        });

    }
}
