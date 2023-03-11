<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniteModel extends Model
{
    use HasFactory;
    public $table='unite';
    public $primaryKey='unite_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
