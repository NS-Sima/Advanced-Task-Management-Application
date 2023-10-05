<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class User_Teams extends Pivot
{
    use HasFactory;
    protected $table="user_teams";
    protected $primaryKey="userTeam_id";
    public $incrementing=true;
    protected $fillable=[
        'user_id',
        'team_id'
    ];
    //This table can be empty as it inherits
}
