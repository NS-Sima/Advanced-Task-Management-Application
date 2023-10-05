<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Users;
class Comments extends Model
{
    use HasFactory;
    protected $table="comments";
    protected $primaryKey="comm_id";
    public $incrementing=true;

    protected $fillable=[
        'user_id',
        'task_id',
        'comment',

    ];
    //Establishing relationship to users table
    public function users():BelongsTo{
        return $this->belongsTo(Users::class,'user_id','comm_id');
    }
}
