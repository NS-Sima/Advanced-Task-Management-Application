<?php

namespace Database\Seeders;

use App\Models\User_Teams;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
use App\Models\Teams;
use App\Models\Tasks;
use Illuminate\Support\Facades\Hash;
class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seeder to save dafault users as admin
        Users::create([
            'name'=>'System Administrator',
            'email'=>'systemadmin@gmail.com',
            'role'=>'admin',
            //set password that you will use, i'll use default
            'password'=>Hash::make(1234),
        ]);
        Users::create([
            'name'=>'System Manager',
            'email'=>'system_manager@gmail.com',
            'role'=>'manager',
            //set password that you will use, i'll use default
            'password'=>Hash::make(1234),
        ]);
        Users::create([
            'name'=>'System user',
            'email'=>'systemuser@gmail.com',
            'role'=>'user',
            //set password that you will use, i'll use default
            'password'=>Hash::make(1234),
        ]);
        Teams::create([
            'teamName'=>'System Team',
            'descriptions'=>'Default team created to allow initial functionality',
            'manager_id'=>2,
        ]);

        Tasks::create([
            'title'=>'System Task',
            'description'=>'Default task created to allow initial functionality',
            'priority'=>1, //you can use 1,2,3 to implement high,medium,low
            'due_date'=>'4/10/2023',
            'user_id'=>3,
            'team_id'=>1,
        ]);

        User_Teams::create([
            'user_id'=>3,
            'team_id'=>1,
        ]);
    }
}
