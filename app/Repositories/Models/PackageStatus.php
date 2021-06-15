<?php

namespace App\Repositories\Models;

use Database\Factories\PackageStatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'package_status';
    protected $fillable = [
        'id_package',
        'id_status',
        'locale'
    ];

    protected $with = [
        'status'
    ];

    public function status()
    {
        return $this->hasOne(Status::class, 'id_status', 'id');
    }

    protected static function newFactory()
    {
        return PackageStatusFactory::new();
    }
}
