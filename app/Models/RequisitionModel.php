<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionModel extends Model
{
    use HasFactory;
    public $table='requisition';
    public $primaryKey='requisition_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;

    public function req_log(){
        return $this->hasMany('App\Models\RequisitionLogModel','reference','requisition_id');
    }
}
