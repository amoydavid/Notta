<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserCreated;
use App\Models\InviteToken;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, UserActivateChannel;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $validator->after(function ($validator) use ($data) {
            $token = $data['token']??false;
            if ($token && !InviteToken::valid($token)) {
                $validator->errors()->add('token', '邀请码不正确或已过期');
            }
        });

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $needActivate = config('wizard.need_activate');
        $token = $data['token']??false;
        if($token!==false) {
            $InviteToken = InviteToken::valid($token);
            if(!$InviteToken) {
                throw new AccessDeniedHttpException('邀请码不正确');
            }
        }

        $user         = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'role'     => $InviteToken?User::ROLE_EXT:User::ROLE_NORMAL,
            'status'   => $needActivate ? User::STATUS_NONE : User::STATUS_ACTIVATED,
        ]);

        // 如果创建的用户是系统中第一个用户，则自动设置其为管理员
        if ((int)$user->id === 1) {
            $user->role = User::ROLE_ADMIN;
            $user->save();
        }

        if(isset($InviteToken)) {
            $InviteToken->setUsed($user);
        }

        // 注册后发送激活邮件
        if ($needActivate) {
            $this->sendUserActivateEmail($user);
        }

        event(new UserCreated($user));

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $token = request()->get('token');
        if( (!ldap_enabled() && !wework_enabled() ) || ($token && !InviteToken::valid($token))) {
            abort(403, '站点暂停注册');
        }
        return view('auth.register', ['token'=>$token]);
    }
}
