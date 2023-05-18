<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MClient extends Model
{
    use HasFactory;
    protected $table = 'tb_m_client';
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'client_name',
        'client_address',
    ];
}
