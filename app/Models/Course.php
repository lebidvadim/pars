<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'send_currency',
        'receive_currency',
        'send_rate',
        'receive_rate'
    ];

    public function scopeFilter($query, Request $request)
    {
        if ($request->has('send_currency')) {
            $query->where('send_currency', $request->get('send_currency'));
        }
        if ($request->has('receive_currency')) {
            $query->where('receive_currency', $request->get('receive_currency'));
        }
        return $query;
    }

}
