<?php

namespace App\Modules\Request\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'status',
        'message',
        'comment',
    ];

    public function scopeFilterByStatus(Builder $query)
    {
        if ($query->status) {
            return $query->where('status', $query->status);
        }
        if ($query->startDate) {
            $query->whereDate('created_at', '>=', $query->startDate);
        }

        if ($query->endDate) {
            $query->whereDate('created_at', '<=', $query->endDate);
        }

        return $query;
    }

}
