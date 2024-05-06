<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reconciliation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'action_by', 'id');
    }
}
