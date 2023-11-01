<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    use HasFactory;
    protected $table = 'user_profiles'; // Вказати ім'я таблиці, якій відповідає ця модель
    protected $primaryKey = 'profile_id'; // Вказати первинний ключ таблиці
    public $incrementing = true; // Чи автоінкрементний первинний ключ
    public $timestamps = true; // Включити поля "created_at" і "updated_at"

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'group_id',
        'depart_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class, 'depart_id');
    }
}
