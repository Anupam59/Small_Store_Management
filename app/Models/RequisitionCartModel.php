<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionCartModel extends Model
{
    use HasFactory;
    public $table='requisition_cart';
    public $primaryKey='requisition_cart_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
