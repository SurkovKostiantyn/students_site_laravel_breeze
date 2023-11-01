<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $table = 'specialities'; // Вказати ім'я таблиці, якій відповідає ця модель
    protected $primaryKey = 'spec_id'; // Вказати первинний ключ таблиці
    public $incrementing = true; // Чи автоінкрементний первинний ключ
    public $timestamps = false; // Вимкнути поля "created_at" і "updated_at", якщо вони не використовуються

    protected $fillable = [
        'full_name',
        'short_name',
        'code',
        'info',
    ];
}
