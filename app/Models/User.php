<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Admin;
use App\Models\Profile;
use App\Models\Librarian;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Headman;
use App\Models\Curator;
/**
 * Class User
 *
 * @property int $id
 * @property string $login
 * @property string $email
 *
 * @property \App\Models\Admin $admin
 * @method static whereDoesntHave(string $string)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Profile::class, 'id');
    }

    public function admin(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Admin::class, 'id');
    }

    public function librarian(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Librarian::class, 'id');
    }

    public function teacher(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Teacher::class, 'id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Student::class, 'id');
    }

    public function headman(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Headman::class, 'id');
    }

    public function curator(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Curator::class, 'id');
    }

}
