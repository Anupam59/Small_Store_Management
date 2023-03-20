<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionLogModel extends Model
{
    use HasFactory;
    public $table='requisition_log';
    public $primaryKey='requisition_log_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
