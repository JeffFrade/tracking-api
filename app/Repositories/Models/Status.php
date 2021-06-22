<?php

namespace App\Repositories\Models;

use Database\Factories\StatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'status';
    protected $fillable = [
        'status'
    ];

    protected static function newFactory()
    {
        return StatusFactory::new();
    }
}
