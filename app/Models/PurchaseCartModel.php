<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseCartModel extends Model
{
    use HasFactory;
    public $table='purchase_cart';
    public $primaryKey='purchase_cart_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
