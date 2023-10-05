<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Teams;
use App\Models\Users;
use App\Models\Tasks;
use App\Models\User_Teams;
class AdminController extends Controller
{

    //function used to check and verify user and direct to dashboards
    //used to perform fnxs apart from signin controller
    public function index(){

        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        //check if session manager started on authentication exist
        if (session()->has('admin')) {
            $user=Users::where('email',session('admin'))->first();
            $users=Users::where('role','user')->count();
            $admins=Users::where('role','admin')->count();
            $managers=Users::where('role','manager')->count();
            $teams=Teams::count();
            $fname=$user['name'];
            $message="Welcome dear ".$fname." You signed as System Administrator";
            return view('admins.index',compact('message','users','admins','managers','teams'));
        }
    }

    //method list all managers registered in the system
    public function listManagers(){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $managers=Users::where('role','manager')->paginate(5);
        return view('admins.managers')->with('managers',$managers);

    }


    //function to view team registration form to database
    public function getTeamForm(){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $managers=Users::where('role','manager')->get();
        return view('admins.register_team')->with('managers',$managers);
    }
        //function to register team to database
        public function registerTeam(Request $request){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $team=new Teams();
            $team->teamName=$request->input('name');
            $team->manager_id=$request->input('manager');
            $team->descriptions=$request->input('desc');
            if ($team->save()==1) {
                $response="Team created successfull";
                return redirect('/admins/teams/reg_team')->with('status',$response);
            }else {
                $response="Team registration failed successfull";
                return redirect('/admins/teams/reg_team')->with('error',$response);
            }
        }

        //function to view register a manager
        public function regUsersForm(){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            return view('admins.registerUSers');
        }

        //Functions to register manager since they should be created by admin
        public function registerUsers(Request $request){ //For managers only from admin
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $user=new Users();
            $user->name=$request->input('name');
            $user->email=$request->input('email');
            $deafultPassword=1234;
            $user->password=Hash::make($request->input('password'));
            $user->role=$request->input('role');
            if ($user->save()==1) {
                $response="User created with default password";
                return redirect('/admins/users/reg')->with('success',$response);
            }else {
                $response="Fail to creat user";
                return redirect('/admins/users/reg')->with('error',$response);
            }
        }

        //function to view temanager informations
        public function viewUser(Request $request,$managerId){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $manager=Users::find($managerId);
            $managerTasks=Tasks::where('user_id',$managerId)->count();
            $managerTeams=Teams::where('manager_id',$managerId)->count();
            return view('admins.users_info')->with('manager',$manager)
            ->with('tasks',$managerTasks)->with('countedTeams',$managerTeams);
        }

        //function to edit users/managers
        public function editUserView(Request $request,$managerId){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $manager=Users::find($managerId);
            return view('admins.editUsers')->with('user',$manager);
        }
        public function updateUsers(Request $request,$userId){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $user=Users::find($userId);
            $user->name=$request->input('name');
            $user->role=$request->input('role');
            $user->email=$request->input('email');
            if ($user->save()==1) {
                $response="User updated successfuly";
                return redirect('/admins/manager/editView/'.$userId)->with('success',$response);
            }else {
                $response="User updation failed";
                return redirect('/admins/manager/editView/'.$userId)->with('error',$response);
            }
        }

       //function to delete users/managers
       public function deleteUsers(Request $request,$userId){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $user=Users::find($userId);
        if ($user->delete()==1) {
            $response="User deleted completely";
            return redirect('/admins/managers')->with('error',$response);
        }else{
            $response="Fail to delete user";
            return redirect('/admins/managers')->with('error',$response);
        }
       }

    //method to view all created teams either by admin or managers
    public function teamsCreated(){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $teams=DB::table('users')->join('teams','users.user_id','=','teams.manager_id')
        ->select('users.name','teams.manager_id','users.email','teams.teamName','teams.team_id')->where('users.role','=','manager')->paginate(5);
        return view('admins.teams')->with('teams',$teams);
    }

    public function teamDetails(Request $request,$teamId){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $team=DB::table('users')->join('teams','users.user_id','=','teams.manager_id')
        ->select('users.name','teams.manager_id','users.email','teams.teamName','teams.team_id')->where('users.role','=','manager')->first();
        $teamTasks=Tasks::where('team_id',$teamId)->count();
        return view('admins.teamDetails')->with('teamDetails',$team)->with('tasks',$teamTasks);

    }

    public function editTeam(Request $request,$teamId){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $team=Teams::find($teamId);
        $managers=Users::where('role','manager')->get();
        return view('admins.edit_team')->with('team',$team)->with('managers',$managers);
    }

    public function handleTeamUpdation(Request $request,$teamId){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $team=Teams::find($teamId);
        $team->teamName=$request['name'];
        $team->manager_id=$request['manager'];
        $team->descriptions=$request['desc'];
        if ($team->save()==1) {
            $response="Team updated successfully";
            return redirect('/admins/teams')->with('status',$response);
        }else{
            $response="Team updation failed";
            return redirect('/admins/teams/'.$teamId)->with('error',$response);
        }

    }


    public function deleteTeam(Request $request,$teamId){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $team=Teams::find($teamId);
        if ($team->delete()==1) {
            $response="Team deleted successfull";
            return redirect('/admins/teams')->with('error',$response);
        }else {
            $response="Fail to successfull";
            return redirect('/admins/teams')->with('warning',$response);
        }

    }

    //function to assign users to teams
    public function getAssignTeamUsers(){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $users=Users::all();
        $teams=Teams::all();
        return view('admins.assignTeamUsers')->with('users',$users)->with('teams',$teams);
    }

    //function to save data to user's team to dab
    public function saveUserTeam(Request $request){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $selectedUsers = $request->input('selectedUser', []);
        $team_id=$request->input('teams');
        foreach ($selectedUsers as $userId => $value) {
            // Check if the checkbox is selected
            if ($value === 'on') {
                $teamUser = new User_Teams();
                $teamUser->team_id=$team_id;
                $teamUser->user_id=$userId;
                $teamUser->save();
            }
        }
        $response="User asigned to team successfully";
        return redirect('/admins/teams/asign_user')->with('status',$response);
    }

    //method to list all tasks assigned(created) to users or teams
    public function tasksCreated(){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $tasks=Tasks::paginate(10);
        return view('admins.tasks')->with('tasks',$tasks);
    }

    //functio to get/view a registration page of tasks
    public function getTaskForm(Request $request){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        return view('admins.asignTask');
    }

    //method to list all users registered in the system
    public function usersRegistered(){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $users=Users::paginate(5);
        return view('admins.users')->with('users',$users);
    }

    //FUNCTIONS TO TASKS MANAGEMENTS

    public function createTasks(Request $request){
        if(session('admin')==null || session('role')!='admin'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $task=new Tasks();
        $task->title=$request->input('title');
        $task->description=$request->input('desc');
        $task->priority=$request->input('priority');
        //status left to default 0, it will be changed to diffenet status
        //0-todo Performed, 1-initialized,2-quartile,3-half,4-third-quartile,5-completed
        $category=$request->input('category');
        $task->due_date=$request->input('dua_date');
        $task->user_id=3; //initialized task to default user admin
        $task->team_id=1;
        if ($task->save()==1) {
            session()->put('category');
            //After go to the mext page in function selectParticipants to select user to be asigned to
            $response="Select task based on cartegory to asign task you created";
           return redirect('/tasks/select_participants/to/')->with('category',$category)->with('status',$response);
        }else{
            $response="Fail to create and assign tasks to participants";
            return redirect('/admins/tasks/reg')->with('error',$response);
        }
    }

        //method to handle ajax requests from database for task cartegory
        public function selectParticipants(Request $request){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            // return session('category');
            $teams=Teams::all();
            $users=Users::all();
            if (session('category')=="Teams") {
                $team="team";
                session()->put('type',$team);
                return view('admins.asignPaticipants',compact('teams','users'));
            }elseif (session('category')=="User") {
                $user="user";
                session()->put('type',$user);
                return view('admins.asignPaticipants',compact('users','teams'));
            }else{
                $response="Please select one cartegory to assign tasks";
                return redirect('/admins/tasks/reg')->with('error',$response);
            }
        }

        //function to asign task to users/teams/managers
        public function assignTask(Request $request){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            // $checkboxesOns=$request->input('selectedTeam');
            $lastTask=Tasks::latest()->first();
            $title=$lastTask['title'];
            $desc=$lastTask['description'];
            $priority=$lastTask['priority'];
            $due_date=$lastTask['due_date'];

            if (session('type')=='team') {
                $selectedTeams = $request->input('selectedTeam', []);
                foreach ($selectedTeams as $teamId => $value) {
                    // Check if the checkbox is selected
                    if ($value === 'on') {
                        $task = new Tasks();
                        $task->title=$title;
                        $task->description=$desc;
                        $task->priority=$priority;
                        $task->due_date=$due_date;
                        $task->user_id=3;
                        $task->team_id=$teamId;
                        $task->save();
                        $response="Task Created and assigned to all selected participants";
                        return redirect('/admins/tasks/reg')->with('status',$response);
                    }
                }
            }elseif (session('type')=='user') {
                $selectedUsers = $request->input('selectedUser', []);
                foreach ($selectedUsers as $userId => $value) {
                    // Check if the checkbox is selected
                    if ($value === 'on') {
                        $task = new Tasks();
                        $task->title=$title;
                        $task->description=$desc;
                        $task->priority=$priority;
                        $task->due_date=$due_date;
                        $task->team_id=1;
                        $task->user_id=$userId;
                        $task->save();
                        $response="Task Created and assigned to all selected participants";
                        return redirect('/admins/tasks/reg')->with('status',$response);
                    }
                }
            }else{
                $response="Please select one cartegory to assign tasks";
                return redirect('/admins/tasks/reg')->with('error',$response);
            }
        }

        //function to return task details page
        public function deleteTasks(Request $request,$taskId){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $task=Tasks::find($taskId);
            if ($task->delete()==1) {
                $response="Task deleted successfull";
                return redirect('/admins/tasks')->with('error',$response);
            }else {
                $response="Fail to delete task";
                return redirect('/admins/tasks')->with('warning',$response);
            }
        }

        //functions to update tasks
        public function editTaskView(Request $request,$taskId){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $task=Tasks::find($taskId);
            return view('admins.editTask')->with('taskInfo',$task);
        }
        public function updateTaskData(Request $request,$taskId){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $task=Tasks::find($taskId);
            $task->title=$request->input('title');
            $task->description=$request->input('desc');
            $task->priority=$request->input('priority');
            $task->due_date=$request->input('dua_date');
            if ($task->save()==1) {
                $response="Task updated successfull";
                return redirect('/admins/tasks')->with('status',$response);
            }else {
                $response="Fail to update task informations";
                return redirect('/admins/tasks')->with('danger',$response);
            }
        }
        //function to read all users comments
        public function viewComments(){
            if(session('admin')==null || session('role')!='admin'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $comments=DB::table('users')->join('comments','users.user_id','=','comments.user_id')
            ->join('attachments','comments.task_id','=','attachments.task_id')
            ->join('tasks','attachments.task_id','=','tasks.task_id')
            ->select('users.name','tasks.title','comments.comment','comments.created_at','attachments.file_name')->paginate(5);

            return view('admins.viewComments')->with('comments',$comments);
        }
}

