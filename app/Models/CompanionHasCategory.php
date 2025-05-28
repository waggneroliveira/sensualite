<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanionHasCategory extends Model
{
    use HasFactory;
    protected $table = 'companion_category_has_companions';
    protected $fillable = ['companion_category_id', 'companion_id'];
}
