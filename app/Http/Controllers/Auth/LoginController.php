<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param User    $user
     *
     * @throws ValidationException
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->isDisabled()) {
            $this->guard()->logout();
            $request->session()->invalidate();

            throw ValidationException::withMessages(['email' => '用户已禁用']);
        }
    }

    public function WeWorkLogin(Request $request)
    {
        if(!wework_enabled()) {
            return redirect('/login');
        }
        $code = $request->get('code');
        if($code) {
            try{
                $work = \EasyWeChat::work();
                $user = $work->oauth->detailed()->user();
                $userId = $user->getId();
                $SocialAccount = SocialAccount::initWeWork($userId);
                if($SocialAccount) {
                    $this->guard()->login($SocialAccount->user, false);
                    return $this->sendLoginResponse($request);
                }
            }catch (\Throwable $e) {
                dd($e->getMessage());
            }
        }

        $state = 'web_login';
        $request->session()->put('state', $state);
        $callbackUrl = route('user:wework.login'); // 需设置可信域名
        $url = 'https://open.work.weixin.qq.com/wwopen/sso/qrConnect?appid='.config('wechat.work.default.corp_id').'&agentid='.config('wechat.work.default.agent_id').'&redirect_uri='.urlencode($callbackUrl).'&state='.$state;
        return response()->redirectTo($url);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        $is_user_state = true;
        if(wework_enabled()) {
            $state = 'web_login';
            $request->session()->put('state', $state);
            if($request->isMethod('GET') && !$request->session()->get('errors')) {
                $is_user_state = false;
            }
        }

        return view('auth.login', [
            'is_user_state' => $is_user_state
        ]);
    }
}
