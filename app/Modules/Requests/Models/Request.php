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



}
