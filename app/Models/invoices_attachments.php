<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_attachments extends Model
{


    protected $guarded =[];

    public function invoices()
    {
        return $this->belongsTo(invoices::class);
    }
    use HasFactory;
}
