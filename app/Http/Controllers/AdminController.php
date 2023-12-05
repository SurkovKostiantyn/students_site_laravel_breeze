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

/**
 * Class AdminController
 *
 * @package App\Http\Controllers
 *
 * @var $admins - list of users from table admins. Also need to join profiles
 * @var $users - list of users from table users. Also need to join profiles
 * @var $notAdmins - list of users from table users that not present in admins table. Also need to join profiles
 * how to get user from array:
 * user->profile->first_name
 * admin->user->profile->last_name
 * admin->user->email
 */
class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $admins = Admin::with(['user.profile'])->get();
        $usersNotAdmins = User::whereDoesntHave('admin')->with(['profile'])->get();
        $users = User::with(['profile'])->get();

        return view('admin', [
            'admins' => $admins,
            'users' => $users,
            'list' => $usersNotAdmins,
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
