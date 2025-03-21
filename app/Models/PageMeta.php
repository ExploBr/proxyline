<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageMeta extends Model
{
    use HasFactory;

    protected $table = 'page_metas';
    protected $guarded = [];
}
