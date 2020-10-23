<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userpost extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "email", "reason_for_appointment"
    ];
}
