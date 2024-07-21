<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBanjir extends Model
{
    use HasFactory;

    protected $table = 'laporanbanjir';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followUpUser()
    {
        return $this->belongsTo(User::class, 'follow_up_user_id');
    }
}
