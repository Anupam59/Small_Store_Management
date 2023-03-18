<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTampModel extends Model
{
    use HasFactory;
    public $table='purchase_tamp';
    public $primaryKey='purchase_tamp_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
