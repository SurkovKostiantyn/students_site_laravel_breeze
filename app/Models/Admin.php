<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Admin extends Model
{
    use HasFactory; // Включити фабрику для моделі
    protected $table = 'admins';
    protected $primaryKey = 'admin_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function isUserAdmin($userId): bool
    {
        return Admin::where('id', $userId)->exists();
    }
}
