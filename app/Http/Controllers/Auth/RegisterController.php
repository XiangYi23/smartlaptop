<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['nullable', 'boolean'],
            'admin_password' => ['required_if:is_admin,1'], // Validation for admin password when is_admin is 1
        ]);
    }

    protected function create(array $data)
    {
        $isAdmin = isset($data['is_admin']) && $data['is_admin'];

        // Check if the user is trying to register as an admin
        if ($isAdmin) {
            $adminPassword = $data['admin_password'];

            // Get the stored admin password from the configuration
            $storedAdminPassword = config('admin.admin_password');

            // Verify the admin password
            if ($adminPassword !== $storedAdminPassword) {
                return redirect()->route('register')->withErrors(['admin_password' => 'Admin password is incorrect']);
            }
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_admin' => $isAdmin,
            'password' => Hash::make($data['password']),
        ]);
    }

    // Override the default register method
    public function register(Request $request)
{
    $this->validator($request->all())->validate();

    // Check if the user is trying to register as an admin
    if ($request->input('is_admin')) {
        $adminPassword = $request->input('admin_password');
        $storedAdminPassword = config('admin.admin_password'); // 获取存储的管理员密码

        // 验证管理员密码
        if ($adminPassword !== $storedAdminPassword) {
            return redirect()->route('register')->withErrors(['admin_password' => 'Admin password is incorrect']);
        }
    }

    $user = $this->create($request->all());

    if ($user) {
        return redirect($this->redirectPath());
    } else {
        return redirect()->route('register')->withErrors(['registration_failed' => 'Registration failed']);
    }
}

}
