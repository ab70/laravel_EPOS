<?php
    /**
     * Created by PhpStorm.
     * User: Sayem
     * Date: 31-Jul-19
     * Time: 10:13 PM
     */

    namespace App\Http\Controllers\Auth;
    namespace App\Http\Controllers\Auth;

    use Illuminate\Foundation\Auth\AuthenticatesUsers;

    use Illuminate\Http\Request;

    class AdminLoginController
    {
        use AuthenticatesUsers;



        protected $guard = 'admin';



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



        public function showLoginForm()

        {

            return view('auth.adminLogin');

        }



        public function login(Request $request)

        {

            if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' =>  $request->password])) {

                dd(auth()->guard('admin')->user());

            }



            return back()->withErrors(['email' => 'Email or password are wrong.']);

        }
    }
