<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLogModel extends Model
{
    use HasFactory;
    public $table='product_log';
    public $primaryKey='product_log_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
