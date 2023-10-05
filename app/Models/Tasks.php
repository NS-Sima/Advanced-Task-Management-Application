<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Users;
class Tasks extends Model
{
    use HasFactory;
    protected $table="tasks";
    protected $primaryKey="task_id";
    public $incerementing=true;

    protected $fillable=[
        'title',
        'description',
        'priority',
        'status',
        'due_date',
        'user_id',
        'team_id'
    ];
    //Establishing relation to users table
    public function users():BelongsTo{
        return $this->belongsTo(Users::class,'user_id','task_id');
    }
}
