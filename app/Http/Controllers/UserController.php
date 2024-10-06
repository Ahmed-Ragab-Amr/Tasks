<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function changeLang($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string',
        ]);

        $user = User::where('email' , $request->email)->first();
        if(!$user)
        {
            return redirect()->back()->withErrors([
                'email'=>'User Not Found',
            ]);
        }

        if(Hash::check($request->password, $user->password))
        {
            $remember = $request->has('remember_me') ? true : false;

            Auth::login($user, $remember);

            if($user->user_type == 'admin'){
                return redirect()->route('admin.dashborad');
            }
            else if($user->user_type == 'employee'){
                return redirect()->route('employee.dashboard');
            }
            else if($user->user_type == 'manager'){
                return redirect()->route('manager.dashboard');
            }

        }

        return redirect()->back()->withErrors([
            'password'=>'password is incorrect',
        ]);
    }



    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|min:8|string',
            'user_type'=>'required|string|in:employee,manager',
        ]);

        $request['password'] = Hash::make($request->password);



        $user = User::create($request->all());

        if($user->user_type == 'employee')
        {
            return redirect()->route('employee.show');
        }else if($user->user_type == 'manager')
        {
            return redirect()->route('manager.show');
        }

    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit' , ['user'=>$user]);
    }

    public function update(Request $request , $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name'=>'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password'=>'nullable|min:8',
            'user_type'=>'required|string|in:employee,manager',
        ]);

        if ($request->filled('password')) {

            $request['password'] = Hash::make($request->password);

        }

        else {
            $request['password'] = $user->getOriginal('password');
        }



        $user->update($request->all());

        if($user->user_type == 'employee')
        {

            return redirect()->route('employee.show');

        }

        else if($user->user_type == 'manager')
        {

            return redirect()->route('manager.show');

        }

    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect()->back();
    }
}
