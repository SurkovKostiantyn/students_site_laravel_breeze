<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups'; // Вказати ім'я таблиці, якій відповідає ця модель
    protected $primaryKey = 'group_id'; // Вказати первинний ключ таблиці
    public $incrementing = true; // Чи автоінкрементний первинний ключ
    public $timestamps = false; // Вимкнути поля "created_at" і "updated_at", якщо вони не використовуються

    protected $fillable = [
        'depart_id',
        'group_name',
        'year',
        'info',
    ];

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Department', 'depart_id');
    }
}
