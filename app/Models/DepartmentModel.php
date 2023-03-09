<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    use HasFactory;
    public $table='department';
    public $primaryKey='department_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;

}
