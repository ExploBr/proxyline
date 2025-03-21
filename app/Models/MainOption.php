<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainOption extends Model
{
    use HasFactory;

    protected $table = 'main_options';
    protected $guarded = false;
}
