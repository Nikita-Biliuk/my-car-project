<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortCode extends Model
{
    protected $table = 'shortcodes';
    protected $fillable =[
        'shortcode',
        'replace',
    ];
}
