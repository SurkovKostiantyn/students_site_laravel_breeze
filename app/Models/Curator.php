<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Curator extends Model
{
    use HasFactory;
    protected $table = 'curators'; // Вказати ім'я таблиці, якій відповідає ця модель
    protected $primaryKey = 'curator_id'; // Вказати первинний ключ таблиці
    public $incrementing = true; // Чи автоінкрементний первинний ключ
    public $timestamps = true; // Включити поля "created_at" і "updated_at"

    protected $fillable = [
        'id',
        'teacher_id',
        'group_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
