<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'sector_id',
        'stock_shortname',
        'stock_name',
    ];
}
