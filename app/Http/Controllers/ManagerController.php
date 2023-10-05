<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Tasks;
use App\Models\Teams;
use App\Models\User_Teams;

class ManagerController extends Controller
{
    //function used to check and verify user/managers
    //used to perform fnx apart from signin controller
    public function index(){
        if(session('manager')==null || session('role')!='manager'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        //check if session manager started on authentication exist
        if (session()->has('manager')) {
            $user=Users::where('email',session('manager'))->first();
            $users=Users::where('role','user')->count();
            $managers=Users::where('role','manager')->count();
            $teams=Teams::count();
            $fname=$user['name'];
            $message="Welcome dear ".$fname." You signed as Manager";
            return view('managers.index',compact('message','users','managers','teams'));
        }
    }

    //method to list all tasks assigned(created) to users or teams
    public function tasksCreated(){
        if(session('manager')==null || session('role')!='manager'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $tasks=Tasks::paginate(10);
        return view('managers.tasks')->with('tasks',$tasks);
    }
    public function managerTasks(Request $request,$manager){
        if(session('manager')==null || session('role')!='manager'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $user=Users::where('email',$manager)->first();
        $userId=$user['user_id'];
        $tasks=Tasks::where('user_id',$userId)->paginate(5);
        return view('managers.individualTasks')->with('tasks',$tasks);
    }


    //function to create tasks as manager
    public function getTaskForm(Request $request){
        if(session('manager')==null || session('role')!='manager'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        return view('managers.asignTask');
    }
    //FUNCTIONS TO TASKS MANAGEMENTS

    public function createTasks(Request $request){
        if(session('manager')==null || session('role')!='manager'){
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
           return redirect('/managers/tasks/select_users/to')->with('category',$category)->with('status',$response);
        }else{
            $response="Fail to create and assign tasks to participants";
            return redirect('/managers/tasks/reg')->with('error',$response);
        }
    }

        //method to handle ajax requests from database for task cartegory
        public function selectParticipants(Request $request){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            // return session('category');
            $teams=Teams::all();
            $users=Users::all();
            if (session('category')=="Teams") {
                $team="team";
                session()->put('type',$team);
                return view('managers.asignPaticipants',compact('teams','users'));
            }elseif (session('category')=="User") {
                $user="user";
                session()->put('type',$user);
                return view('managers.asignPaticipants',compact('users','teams'));
            }else{
                $response="Please select one cartegory to assign tasks";
                return redirect('/managers/tasks/reg')->with('error',$response);
            }
        }

        //function to asign task to users/teams/managers
        public function assignTask(Request $request){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
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
                        return redirect('/managers/tasks/reg')->with('status',$response);
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
                        return redirect('/managers/tasks/reg')->with('status',$response);
                    }
                }
            }else{
                $response="Please select one cartegory to assign tasks";
                return redirect('/managers/tasks/reg')->with('error',$response);
            }
        }

        //function to return task details page
        public function deleteTasks(Request $request,$taskId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $task=Tasks::find($taskId);
            if ($task->delete()==1) {
                $response="Task deleted successfull";
                return redirect('/managers/my_tasks/'.session('manager'))->with('error',$response);
            }else {
                $response="Fail to delete task";
                return redirect('/managers/my_tasks/'.session('manager'))->with('warning',$response);
            }
        }

        //functions to update tasks
        public function editTaskView(Request $request,$taskId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $task=Tasks::find($taskId);
            return view('managers.editTask')->with('taskInfo',$task);
        }
        public function updateTaskData(Request $request,$taskId){
            $task=Tasks::find($taskId);
            $task->title=$request->input('title');
            $task->description=$request->input('desc');
            $task->priority=$request->input('priority');
            $task->due_date=$request->input('dua_date');
            if ($task->save()==1) {
                $response="Task updated successfull";
                return redirect('/managers/my_tasks/'.session('manager'))->with('status',$response);
            }else {
                $response="Fail to update task informations";
                return redirect('/managers/my_tasks/'.session('manager'))->with('error',$response);
            }
        }


    //method to list all users registered in the system
    public function usersRegistered(){
        if(session('manager')==null || session('role')!='manager'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $users=Users::paginate(5);
        return view('managers.users')->with('users',$users);
    }
        //function to view team registration form to database
    public function getTeamForm(){
        if(session('manager')==null || session('role')!='manager'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $managers=Users::where('role','manager')->get();
        return view('managers.register_team')->with('managers',$managers);
    }
        //function to register team to database
        public function registerTeam(Request $request){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $team=new Teams();
            $team->teamName=$request->input('name');
            $team->manager_id=$request->input('manager');
            $team->descriptions=$request->input('desc');
            if ($team->save()==1) {
                $response="Team created successfull";
                return redirect('/managers/teams/reg_team')->with('status',$response);
            }else {
                $response="Team registration failed successfull";
                return redirect('/managers/teams/reg_team')->with('error',$response);
            }
        }


        //method to view all created teams either by admin or managers
        public function teamsCreated(){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $teams=DB::table('users')->join('teams','users.user_id','=','teams.manager_id')
            ->select('users.name','teams.manager_id','users.email','teams.teamName','teams.team_id')->where('users.role','=','manager')->paginate(5);
            return view('managers.teams')->with('teams',$teams);
        }

        public function teamDetails(Request $request,$teamId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $team=DB::table('users')->join('teams','users.user_id','=','teams.manager_id')
            ->select('users.name','teams.manager_id','users.email','teams.teamName','teams.team_id')->where('users.role','=','manager')->first();
            $teamTasks=Tasks::where('team_id',$teamId)->count();
            return view('managers.teamDetails')->with('teamDetails',$team)->with('tasks',$teamTasks);

        }

        public function editTeam(Request $request,$teamId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $team=Teams::find($teamId);
            $managers=Users::where('role','manager')->get();
            return view('managers.edit_team')->with('team',$team)->with('managers',$managers);
        }

        public function handleTeamUpdation(Request $request,$teamId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $team=Teams::find($teamId);
            $team->teamName=$request['name'];
            $team->manager_id=$request['manager'];
            $team->descriptions=$request['desc'];
            if ($team->save()==1) {
                $response="Team updated successfully";
                return redirect('/managers/teams')->with('status',$response);
            }else{
                $response="Team updation failed";
                return redirect('/managers/teams/'.$teamId)->with('error',$response);
            }

        }

        public function deleteTeam(Request $request,$teamId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $team=Teams::find($teamId);
            if ($team->delete()==1) {
                $response="Team deleted successfull";
                return redirect('/managers/teams')->with('error',$response);
            }else {
                $response="Fail to successfull";
                return redirect('/managers/teams')->with('warning',$response);
            }
        }



        //function to view temanager informations
        public function viewUser(Request $request,$managerId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $manager=Users::find($managerId);
            $managerTasks=Tasks::where('user_id',$managerId)->count();
            $managerTeams=Teams::where('manager_id',$managerId)->count();
            return view('managers.users_info')->with('manager',$manager)
            ->with('tasks',$managerTasks)->with('countedTeams',$managerTeams);
        }

        //function to edit users/managers
        public function editUserView(Request $request,$managerId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $manager=Users::find($managerId);
            return view('managers.editUsers')->with('user',$manager);
        }
        public function updateUsers(Request $request,$userId){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $user=Users::find($userId);
            $user->name=$request->input('name');
            $user->role=$request->input('role');
            $user->email=$request->input('email');
            if ($user->save()==1) {
                $response="User updated successfuly";
                return redirect('/managers/users/editView/'.$userId)->with('success',$response);
            }else {
                $response="User updation failed";
                return redirect('/managers/users/editView/'.$userId)->with('error',$response);
            }
        }

       //function to delete users/managers
       public function deleteUsers(Request $request,$userId){
        if(session('manager')==null || session('role')!='manager'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        $user=Users::find($userId);
        if ($user->delete()==1) {
            $response="User deleted completely";
            return redirect('/managers/users')->with('error',$response);
        }else{
            $response="Fail to delete user";
            return redirect('/managers/users')->with('error',$response);
        }
       }

    //function to assign users to teams
    public function getAssignTeamUsers(){
        if(session('manager')==null || session('role')!='manager'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }
        // return session('manager');
        $users=Users::all();
        $manager=Users::where('email',session('manager'))->first();
        $manager_id=$manager['user_id'];
        $managerTeams=Teams::where('manager_id',$manager_id)->get();
        return view('managers.assignTeamUsers')->with('users',$users)->with('teams',$managerTeams);
    }

    //function to save data to user's team to dab
    public function saveUserTeam(Request $request){
        if(session('manager')==null || session('role')!='manager'){
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
        return redirect('/managers/teams/asign_user')->with('status',$response);
    }

        //function to read all users comments
        public function viewComments(){
            if(session('manager')==null || session('role')!='manager'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $comments=DB::table('users')->join('comments','users.user_id','=','comments.user_id')
            ->join('attachments','comments.task_id','=','attachments.task_id')
            ->join('tasks','attachments.task_id','=','tasks.task_id')
            ->select('users.name','tasks.title','comments.comment','comments.created_at','attachments.file_name')->paginate(5);

            return view('managers.viewComments')->with('comments',$comments);
        }
}

