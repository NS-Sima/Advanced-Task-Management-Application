<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//INDEX ROUTE TO REDIRECT TO LOGIN PAGE
Route::get('/', function () {
    return view('Auth.login');
});

//ROUTES FROM AUTHCOUNTOLLER TO REDIRECT TO DAHBOARDS
Route::GET('/admins','App\Http\Controllers\AdminController@index');
Route::GET('/managers','App\Http\Controllers\ManagerController@index');
Route::GET('/users','App\Http\Controllers\UserController@index');

//AUTH ROUTES
ROUTE::GET('/reg_form','App\Http\Controllers\AuthController@viewReg');
ROUTE::POST('/register','App\Http\Controllers\AuthController@register');
ROUTE::POST('/user/signin','App\Http\Controllers\AuthController@signin');
ROUTE::GET('/logout','App\Http\Controllers\AuthController@signout');


// ROUTE TO ADMINS PAGES/CONTROLLERS
//manager or user managements
ROUTE::GET('/admins/managers','App\Http\Controllers\AdminController@listManagers');
ROUTE::GET('/admins/manager/info/{managerId}','App\Http\Controllers\AdminController@viewUser');
ROUTE::GET('/admins/manager/editView/{managerId}','App\Http\Controllers\AdminController@editUserView');
ROUTE::POST('/admins/manager/update_users/{userId}','App\Http\Controllers\AdminController@updateUsers');
ROUTE::GET('/admins/manager/deleteUsers/{userId}','App\Http\Controllers\AdminController@deleteUsers');

ROUTE::GET('/admins/teams','App\Http\Controllers\AdminController@teamsCreated');
ROUTE::GET('/admins/users','App\Http\Controllers\AdminController@usersRegistered');
ROUTE::GET('/admins/users/reg','App\Http\Controllers\AdminController@regUsersForm');
ROUTE::POST('/admins/users/reg/new_user','App\Http\Controllers\AdminController@registerUsers');

//comments
ROUTE::GET('/admins/view/comments','App\Http\Controllers\AdminController@viewComments');

//team management
ROUTE::GET('/admins/team_details/{teamId}','App\Http\Controllers\AdminController@teamDetails');
ROUTE::GET('/admins/delete/team/{teamId}','App\Http\Controllers\AdminController@deleteTeam');
ROUTE::GET('/admins/edit/team/{teamId}','App\Http\Controllers\AdminController@editTeam');
ROUTE::POST('/admins/update_team_info/{teamId}','App\Http\Controllers\AdminController@handleTeamUpdation');

//Admin Registration routes
ROUTE::GET('/admins/teams/reg_team','App\Http\Controllers\AdminController@getTeamForm');
ROUTE::POST('/admins/teams/register-team','App\Http\Controllers\AdminController@registerTeam');
ROUTE::GET('/admins/teams/asign_user','App\Http\Controllers\AdminController@getAssignTeamUsers');
ROUTE::POST('/admins/teams/asign_user/save','App\Http\Controllers\AdminController@saveUserTeam');


//ROUTES TO TASKS CREATIONS AND CONTROLL
ROUTE::GET('/admins/tasks','App\Http\Controllers\AdminController@tasksCreated');
ROUTE::GET('/admins/tasks/reg','App\Http\Controllers\AdminController@getTaskForm');
ROUTE::POST('/tasks/create_task/toward/','App\Http\Controllers\AdminController@createTasks');
ROUTE::GET('/tasks/select_participants/to/','App\Http\Controllers\AdminController@selectParticipants');
ROUTE::POST('/tasks/assign_task_participants','App\Http\Controllers\AdminController@assignTask');
ROUTE::GET('/tasks/delete/{taskId}','App\Http\Controllers\AdminController@deleteTasks');
ROUTE::GET('/tasks/editView/{taskId}','App\Http\Controllers\AdminController@editTaskView');
ROUTE::POST('/tasks/update_task/{taskId}','App\Http\Controllers\AdminController@updateTaskData');


//ROUTES FOR MANAGERS
ROUTE::GET('/managers/tasks','App\Http\Controllers\ManagerController@tasksCreated');
ROUTE::GET('/managers/my_tasks/{manager}','App\Http\Controllers\ManagerController@managerTasks');
ROUTE::GET('/managers/tasks/reg','App\Http\Controllers\ManagerController@getTaskForm');
ROUTE::POST('/managers/task/create/','App\Http\Controllers\ManagerController@createTasks');
ROUTE::GET('/managers/tasks/select_users/to','App\Http\Controllers\ManagerController@selectParticipants');
ROUTE::POST('/managers/tasks/assign_task_participants','App\Http\Controllers\ManagerController@assignTask');
ROUTE::GET('/managers/tasks/delete/{taskId}','App\Http\Controllers\ManagerController@deleteTasks');
ROUTE::GET('/managers/tasks/editView/{taskId}','App\Http\Controllers\ManagerController@editTaskView');
ROUTE::POST('/managers/tasks/update_task/{taskId}','App\Http\Controllers\ManagerController@updateTaskData');

ROUTE::GET('/managers/teams','App\Http\Controllers\ManagerController@teamsCreated');
ROUTE::GET('/managers/users','App\Http\Controllers\ManagerController@usersRegistered');
ROUTE::GET('/managers/teams/asign_user','App\Http\Controllers\ManagerController@getAssignTeamUsers');
ROUTE::POST('/managers/teams/asign_user/save','App\Http\Controllers\ManagerController@saveUserTeam');

//comments
ROUTE::GET('/managers/view/comments','App\Http\Controllers\ManagerController@viewComments');
//team management
ROUTE::GET('/managers/teams/reg_team','App\Http\Controllers\ManagerController@getTeamForm');
ROUTE::POST('/managers/teams/register-team','App\Http\Controllers\ManagerController@registerTeam');
ROUTE::GET('/managers/team_details/{teamId}','App\Http\Controllers\ManagerController@teamDetails');
ROUTE::GET('/managers/delete/team/{teamId}','App\Http\Controllers\ManagerController@deleteTeam');
ROUTE::GET('/managers/edit/team/{teamId}','App\Http\Controllers\ManagerController@editTeam');
ROUTE::POST('/managers/update_team_info/{teamId}','App\Http\Controllers\ManagerController@handleTeamUpdation');
ROUTE::GET('/managers/users/info/{managerId}','App\Http\Controllers\ManagerController@viewUser');
ROUTE::GET('/managers/users/editView/{managerId}','App\Http\Controllers\ManagerController@editUserView');
ROUTE::POST('/managers/users/update_users/{userId}','App\Http\Controllers\ManagerController@updateUsers');
ROUTE::GET('/managers/users/deleteUsers/{userId}','App\Http\Controllers\ManagerController@deleteUsers');

//ROUTES TO USERS
ROUTE::GET('/users/teams/list','App\Http\Controllers\UserController@teamsCreated');
ROUTE::GET('/users/tasks/list','App\Http\Controllers\UserController@userTasks');
ROUTE::GET('/users/tasks/view/{taskId}','App\Http\Controllers\UserController@viewTask');
ROUTE::GET('/users/tasks/edit_status/{taskId}','App\Http\Controllers\UserController@editTaskView');
ROUTE::POST('/users/tasks/update_task/{taskId}','App\Http\Controllers\UserController@updateTaskStatus');

ROUTE::GET('/users/provide/comment','App\Http\Controllers\UserController@getCommenter');
ROUTE::POST('/users/send-comments','App\Http\Controllers\UserController@commentOnTask');
ROUTE::GET('/users/view/comments','App\Http\Controllers\UserController@viewComments');


