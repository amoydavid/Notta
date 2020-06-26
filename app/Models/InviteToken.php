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
     * @param Model $Object
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
}
