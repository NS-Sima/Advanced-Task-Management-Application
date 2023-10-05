<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Tasks;
use App\Models\Comments;
use App\Models\Attachments;
use App\Models\Teams;
class Users extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table="users";
    protected $primaryKey='user_id';
    public $incerementing=true;
     protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

// Establishing relationship between users and tasks
    public function tasks():HasMany{
        return $this->hasMany(Tasks::class,'task_id','user_id');
    }

//Establishing relationship btn users and comments to tasks
    public function comments():HasMany{
        return $this->hasMany(Comments::class,'comm_id','user_id');
    }

// Establishing relationship to attachments table
    public function attachments():HasMany{
        return $this->hasMany(Attachments::class,'att_id','user_id');
    }

//Establishing relationship to teams table
    public function teams():HasMany{
        return $this->hasMany(Teams::class,'team_id','user_id');
    }

// Establishment of relataionship to pivot table(user_teams)
    public function user_team():BelongsToMany
    {
        return $this->belongsToMany(Teams::class, 'user_teams','team_id','user_id','userTeam_id')
            ->withPivot(['custom_field1', 'custom_field2']); // Add any custom pivot fields
    }

}

