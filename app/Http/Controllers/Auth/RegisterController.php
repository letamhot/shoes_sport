<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Gender;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255', 'unique:users'],
        //     'gender' => ['required'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:1', 'confirmed'],
        //     'address' => ['required', 'string', 'max:255'],
        //     'phone' => ['required', 'min: 0'],

        // ]);
        $rules = [
            'name' => 'required|unique:users,name|min:3',
            'gender' => 'required',
            'email' => 'required|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z\-]+\.)+[a-z]{2,6}$/ix|min:10|max:50',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|same:password',
            'address' => 'required|string|min:3|max:25',
            'phone' => 'required|min:9|unique:users',
        ];

        $messages = [
            'required' => 'Vui lòng không để trống trường này!',
            'name.unique'   => 'Dữ liệu này đã tồn tại!',
            'email.unique'  => 'Dữ liệu này đã tồn tại!',
            'email.regex'  => 'Email không đúng định dạng!',
            'password_confirmation.same' => 'Mật khẩu không trùng khớp!'
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone' => $data['phone'],

        ]);
    }

    public function getRegister()
    {
        return view('shoes.login');
    }
    // laravel hỗ trợ hàm dkd rồi nè, sao k sd lại
    public function add(RegisterRequest $request)
    {
        var_dump($request['name']);

        try {
            $message = trans('messages.error');
            $users = Users::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            if (!empty($users)) {
                $message = trans('messages.registered');
                return redirect('/loginshoes')->with('success_msg', $message);
            }
        } catch (\Exception $e) {
            Log::error(__CLASS__ . "::" . __METHOD__ . "  " . $e->getMessage() . "on line" . $e->getLine());
        }
        return redirect('/loginshoes')->with('error_msg', $message);
    }
}