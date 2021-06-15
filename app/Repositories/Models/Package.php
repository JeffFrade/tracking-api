<?php

namespace App\Repositories\Models;

use Database\Factories\PackageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function status()
    {
        return $this->hasMany(PackageStatus::class, 'id', 'id_package');
    }

    protected static function newFactory()
    {
        return PackageFactory::new();
    }
}
