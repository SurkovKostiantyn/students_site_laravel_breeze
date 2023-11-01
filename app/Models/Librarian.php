<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Librarian extends Model
{
    use HasFactory;
    protected $table = 'librarians'; // Вказати ім'я таблиці, якій відповідає ця модель
    protected $primaryKey = 'librarian_id'; // Вказати первинний ключ таблиці
    public $incrementing = true; // Чи автоінкрементний первинний ключ
    public $timestamps = true; // Включити поля "created_at" і "updated_at"

    protected $fillable = [
        'profile_id',
    ];

    public function userProfile(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User_profile::class, 'profile_id');
    }
}