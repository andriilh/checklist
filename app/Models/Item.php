<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'checklist_id'];

    public function checklist()
    {
        $this->belongsTo(Checklist::class, 'checklist_id');
    }
}
