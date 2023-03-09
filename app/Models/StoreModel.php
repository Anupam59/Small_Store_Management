<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreModel extends Model
{
    use HasFactory;
    public $table='store';
    public $primaryKey='store_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
