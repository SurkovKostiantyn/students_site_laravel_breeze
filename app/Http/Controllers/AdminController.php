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
        // how to get profile.first_name and profile.last_name from admins?
        $f_names = [];
        $l_names = [];
        echo '<table>';
        echo '<table>';
        echo '<th>';
        echo '<td>First name</td>';
        echo '<td>Last name</td>';
        echo '<td>Email</td>';
        echo '</th>';
        foreach ($admins as $admin) {
            $f_names[] = $admin->user->profile->first_name;
            $l_names[] = $admin->user->profile->last_name;
            $email = $admin->user->email;
            echo '<tr>';
            echo '<td>' . $admin->user->profile->first_name . '</td>';
            echo '<td>' . $admin->user->profile->last_name . '</td>';
            echo '<td>' . $admin->user->email . '</td>';
        }
        echo '</table>';
        echo '<hr>';

        // need to get data from this users
        $usersNotAdmins = User::whereDoesntHave('admin')->with(['profile'])->get();
        $f_names = [];
        $l_names = [];
        echo '<table>';
        echo '<th>';
        echo '<td>First name</td>';
        echo '<td>Last name</td>';
        echo '<td>Email</td>';
        echo '</th>';
        foreach ($usersNotAdmins as $user) {
            $f_names[] = $user->profile->first_name;
            $l_names[] = $user->profile->last_name;
            $email = $user->email;
            echo '<tr>';
            echo '<td>' . $user->profile->first_name . '</td>';
            echo '<td>' . $user->profile->last_name . '</td>';
            echo '<td>' . $user->email . '</td>';
        }
        echo '</table>';
        exit();

        $users = User::with(['profile'])->get();
        $notAdmins = User::whereNotIn('id', function ($query) {
            $query->select('id')->from('admins');
        })->get();


//        $admins = Admin::with(['user.profile'])->get();
//        $users = Profile::all();
//        // need to get all users that not present in admins table
//        $list = User::whereNotIn('id', function ($query) {
//            $query->select('id')->from('admins');
//        })->get();

        // $firstName = $admin->user->profile->first_name;
        // $lastName = $admin->user->profile->last_name;

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
