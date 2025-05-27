<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'meja';

    protected $fillable = [
        'nomor_meja',
        'qr_code'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'meja_id');
    }
}
