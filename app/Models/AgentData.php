<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentData extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_approved',
        'reason',
        'commission',
        'status_id',
    ];


    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
