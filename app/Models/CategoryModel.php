<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    public $table='category';
    public $primaryKey='category_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
