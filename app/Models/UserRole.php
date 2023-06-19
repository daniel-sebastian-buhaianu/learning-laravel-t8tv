<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_role';

    /**
     * The primary key name in the model's table.
     *
     * @var string
     */
    protected $primaryKey = 'user_role_id';
}
