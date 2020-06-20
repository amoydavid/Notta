<?php

namespace App\Models;

use App\Events\UserCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SocialAccount extends Model
{
    const PROVIDER_WX_WORK = 'wework';

    protected $fillable = [
        'user_id', 'token', 'avatar', 'provider', 'provider_id'
    ];
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $userId
     * @return SocialAccount
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \Throwable
     */
    public static function initWeWork($userId)
    {
        $account = self::query()->where(['provider'=>self::PROVIDER_WX_WORK, 'provider_id'=>$userId])->first();
        if(!$account) {
            $work = \EasyWeChat::work();
            $info = $work->user->get($userId);
            $realName = $info['name'];
            $avatar = $info['avatar'];
            $email = $info['email'];
            $mobile = $info['mobile']??$info['telephone']??$email;

            $formData = [
                'provider' => self::PROVIDER_WX_WORK,
                'provider_id' => $userId,
                'avatar'=>$avatar,
            ];
            $account = \DB::transaction(function() use ($formData, $email, $realName, $mobile){
                $needActivate = config('wizard.need_activate');
                $user         = User::create([
                    'name'     => $realName,
                    'email'    => $email,
                    'password' => bcrypt($mobile),
                    'role'     => User::ROLE_NORMAL,
                    'status'   => $needActivate ? User::STATUS_NONE : User::STATUS_ACTIVATED,
                ]);

                // 如果创建的用户是系统中第一个用户，则自动设置其为管理员
                if ((int)$user->id === 1) {
                    $user->role = User::ROLE_ADMIN;
                    $user->save();
                }

                // 注册后发送激活邮件
                if ($needActivate) {
                    $this->sendUserActivateEmail($user);
                }

                event(new UserCreated($user));

                $formData['token'] = Str::random(32);
                $formData['user_id'] = $user->id;
                $account = self::create($formData);
                return $account;
            });
        }

        return $account;
    }
}
