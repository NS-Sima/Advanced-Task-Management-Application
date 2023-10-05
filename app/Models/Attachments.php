<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Users;
class Attachments extends Model
{
    use HasFactory;
    protected $table="attachments";
    protected $primaryKey="att_id";
    public $incrementing=true;

    protected $fillable=[
        'task_id',
        'file_name',
    ];
    // Establishing relationship between to users table
    public function users():BelongsTo{
        return $this->belongsTo(Users::class,'user_id','att_id');
    }
}
