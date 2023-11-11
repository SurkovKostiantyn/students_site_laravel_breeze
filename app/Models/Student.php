<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students'; // Вказати ім'я таблиці, якій відповідає ця модель
    protected $primaryKey = 'student_id'; // Вказати первинний ключ таблиці
    public $incrementing = true; // Чи автоінкрементний первинний ключ
    public $timestamps = true; // Включити поля "created_at" і "updated_at"

    protected $fillable = [
        'id',
        'group_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
