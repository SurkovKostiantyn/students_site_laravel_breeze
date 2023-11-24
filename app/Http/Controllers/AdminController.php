<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        // $admins - list of users from table admins. Also need to join profiles
        // $users - list of users from table users. Also need to join profiles
        // $notAdmins - list of users from table users that not present in admins table. Also need to join profiles

        $admins = Admin::with(['user.profile'])->get();
        //$admin->user->profile->first_name
        //$admin->user->profile->last_name
        //$admin->user->email

        // need to get data from this users
        $usersNotAdmins = User::whereDoesntHave('admin')->with(['profile'])->get();

        $users = User::with(['profile'])->get();

        foreach ($users as $user) {
            echo $user->profile->first_name.' '.$user->profile->last_name.' '.$user->email.'<br>';
        }
        echo '<hr>';
        foreach ($usersNotAdmins as $user) {
            echo $user->profile->first_name.' '.$user->profile->last_name.' '.$user->email.'<br>';
        }
        echo '<hr>';
        foreach ($admins as $admin) {
            echo $admin->user->profile->first_name.' '.$admin->user->profile->last_name.' '.$admin->user->email.'<br>';
        }

        exit();

        return view('admin', [
            'admins' => $admins,
            'users' => $users,
            'list' => $list,
        ]);
    }

    public function addAdmin(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        // TODO: make it with eloquent
        DB::table('admins')->insert([
            'id' => $id,
        ]);
        return Redirect::back();
    }
}
