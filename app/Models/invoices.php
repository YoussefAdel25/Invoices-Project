<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\section;
use Illuminate\Database\Eloquent\SoftDeletes;


class invoices extends Model
{


    protected $guarded =[];

    public function section(){


       return $this->belongsTo(section::class);
    }


    use SoftDeletes; // تأكد من تضمين SoftDeletes

    protected $dates = ['deleted_at'];
    use HasFactory;
}
