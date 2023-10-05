<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Users;
class Teams extends Model
{
    use HasFactory;
    protected $table="teams";
    protected $primaryKey="team_id";
    public $incrementing=true;

    protected $fillable=[
        'teamName',
        'descriptions',
        'manager_id'
    ];

    //Esatblishing relationship to users table
    public function users():BelongsTo{
        return $this->belongsTo(Users::class,'user_id','team_id');
    }

    //Establishing relationship to pivot tables(user_teams)
    public function team_user():BelongsToMany{
        return $this->belongsToMany(User::class, 'user_teams','user_id','team_id','userTeam_id')
            ->withPivot(['user_id', 'team_id']); // Add any custom pivot fields
    }

}
