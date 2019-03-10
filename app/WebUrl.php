<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class WebUrl extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
        'url',
        'verification_key',
        'verification_status',
        'verified_by_id',
        'verification_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
