<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $table = 'contributions';

    protected $fillable = ['member_id', 'date', 'amount', 'type', 'status', 'reason'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
