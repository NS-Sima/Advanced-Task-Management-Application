<?php

namespace App\Http\Controllers;

use App\Models\Attachments;
use App\Models\User_Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Teams;
use App\Models\Tasks;
use App\Models\Comments;
class UserController extends Controller
{
    //function used to check and verify user and direct to dashboards
    //used to perform fnxs apart from signin controller
    public function index(){
        if(session('user')==null || session('role')!='user'){
            $response="Please login to continue";
            return redirect('/')->with('error',$response);
        }

        //check if session manager started on authentication exist
        if (session()->has('user')) {
            $user=Users::where('email',session('user'))->first();
            $user_id=$user['user_id'];
            $fname=$user['name'];
            // return session('user');
            $tasksCounts=Tasks::where('user_id',$user_id)->count();
            $teamsCounts=User_Teams::where('user_id',$user_id)->count();

            $message="Welcome dear ".$fname." You signed as normal user";
            return view('users.index')->with('message',$message)->with('totalTasks',$tasksCounts)->with('totalTeams',$teamsCounts);
        }
    }

        //method to view all individual team users
        public function teamsCreated(){
            if(session('user')==null || session('role')!='user'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $user_teams=DB::table('users')->join('user_teams','user_teams.user_id','=','users.user_id')
            ->join('teams','teams.team_id','=','user_teams.team_id')
            ->select('users.name','user_teams.team_id','teams.teamName')
            ->where('users.role','=','user')->where(
                function($query){
                $user=Users::where('email',session('user'))->first();
                $user_id=$user['user_id'];
                $query->where('users.user_id','=',$user_id);
            })->paginate(5);
            return view('users.teams')->with('teams',$user_teams);
        }
        //function to return tasks for individual user
        public function userTasks(){
            if(session('user')==null || session('role')!='user'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $user_tasks=DB::table('users')->join('tasks','tasks.user_id','=','users.user_id')
            ->select('tasks.task_id','tasks.title','tasks.priority','tasks.description','tasks.due_date','tasks.status')
            ->where('users.role','=','user')->where(
                function($query){
                $user=Users::where('email',session('user'))->first();
                $user_id=$user['user_id'];
                $query->where('users.user_id','=',$user_id);
            })->paginate(5);
            return view('users.tasks')->with('tasks',$user_tasks);
        }
        //function to view user task descriptions
        public function viewTask(Request $request,$taskId){
            if(session('user')==null || session('role')!='user'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $task=Tasks::find($taskId);
            return view('users.taskDsk')->with('task',$task);
        }
        //functions to change status of task from 1,to,3
        public function editTaskView(Request $request,$taskId){
            if(session('user')==null || session('role')!='user'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $task=Tasks::find($taskId);
            return view('users.starterTask')->with('task',$task);
        }
        //function to change status based on selection
        public function updateTaskStatus(Request $request,$taskId){
            if(session('user')==null || session('role')!='user'){
                $response="Please login to continue";
                return redirect('/')->with('error',$response);
            }
            $task=Tasks::find($taskId);
            $currentStatus=$task['status'];
            $enteredStatus=$request['status'];

            if ($currentStatus==$enteredStatus) {
                $response="check your status and change to next or if task completed can not be changed";
               return redirect('/users/tasks/edit_status/'.$taskId)->with('error',$response);
            }elseif ($currentStatus==0 && $enteredStatus==1) {
                $task->status=1;
                if ($task->save()==1) {
                    $response="status changes to progress state with 70%";
                    return redirect('/users/tasks/edit_status/'.$taskId)->with('status',$response);
                }else{
                    $response="Failed to change status";
                    return redirect('/users/tasks/edit_status/'.$taskId)->with('error',$response);
                }
        }elseif ($currentStatus==0 && $enteredStatus==2 ) {
            $response="You can not skip task stage";
            return redirect('/users/tasks/edit_status/'.$taskId)->with('error',$response);
        }
        elseif($currentStatus==1 && $enteredStatus==2){
            $task->status=2;
            if ($task->save()==1) {
                $response="status changes to progress state with 100%";
                return redirect('/users/tasks/edit_status/'.$taskId)->with('status',$response);
            }else{
                $response="Failed to change status";
                return redirect('/users/tasks/edit_status/'.$taskId)->with('error',$response);
            }
        }elseif ( $currentStatus==1 && $enteredStatus==0) {
            $response="You can not change status to previous state";
            return redirect('/users/tasks/edit_status/'.$taskId)->with('error',$response);
        }
        elseif($currentStatus==2 && $enteredStatus==1 || $currentStatus==2 && $enteredStatus==0){
            $response="You can not change status to previous state";
            return redirect('/users/tasks/edit_status/'.$taskId)->with('error',$response);
        }else{
            $response="Please choose task state correctly";
            return redirect('/users/tasks/edit_status/'.$taskId)->with('error',$response);
        }
}

//function to create comments and attachemnts
public function getCommenter(){
    if(session('user')==null || session('role')!='user'){
        $response="Please login to continue";
        return redirect('/')->with('error',$response);
    }
    $tasks=DB::table('users')->join('tasks','tasks.user_id','=','users.user_id')
    ->select('tasks.task_id','tasks.title','tasks.priority','tasks.description','tasks.due_date','tasks.status')
    ->where('users.role','=','user')->where(
        function($query){
        $user=Users::where('email',session('user'))->first();
        $user_id=$user['user_id'];
        $username=$user['name'];
        session()->put('as',$username);
        $query->where('users.user_id','=',$user_id);
    })->get();
    return view('users.commenting')->with('tasks',$tasks);
}

public function commentOnTask(Request $request){
    if(session('user')==null || session('role')!='user'){
        $response="Please login to continue";
        return redirect('/')->with('error',$response);
    }
    $taskId=$request->input('task');
    $comm=$request['comment'];
    $user=Users::where('email',session('user'))->first();
    $user_id=$user['user_id'];
    $comment=new Comments();
    $comment->user_id=$user_id;
    $comment->task_id=$taskId;
     $comment->comment=$comm;
     if ($comment->save()) {
        if ($request->hasFile('file')) {
            $attachedFile = $request->file('file');
            $attachedFileName = $attachedFile->getClientOriginalName();
            $extension = $attachedFile->getClientOriginalExtension();
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx', 'xlsx'];

            if (!in_array($extension, $allowedExtensions)) {
                return redirect('/users/provide/comment')
                    ->with('error', 'Invalid file extension. Allowed extensions: jpg, jpeg, png, pdf, docx, xlsx');
            }

            $limit = $attachedFile->getSize() / 1024;
            if ($limit > 2048) {
                return redirect('/users/provide/comment')
                    ->with('error', 'Maximum file size to upload should be below 2MB');
            }

            $destinationPath = storage_path('app/public/Attachments/attachments');
            $attachedFile->move($destinationPath, $attachedFileName);

            // Save attachment data to the Attachments model/table.
            $attachment = new Attachments();
            $attachment->task_id = $taskId;
            $attachment->file_name = $attachedFileName;
            $attachment->save();
        }

        $response = "Comment provided successfully";
        if (isset($attachedFileName)) {
            $response .= " with attachment " . $attachedFileName;
        }

        return redirect('/users/provide/comment')->with('status', $response);
    } else {
        $response = "Failed to provide comment";
        return redirect('/users/provide/comment')->with('error', $response);
    }
}//end of function


//function to view comments
public function viewComments(){
    if(session('user')==null || session('role')!='user'){
        $response="Please login to continue";
        return redirect('/')->with('error',$response);
    }
    $comments=DB::table('users')->join('comments','users.user_id','=','comments.user_id')
    ->join('attachments','comments.task_id','=','attachments.task_id')
    ->join('tasks','attachments.task_id','=','tasks.task_id')
    ->select('users.name','tasks.title','comments.comment','comments.created_at','attachments.file_name')->paginate(5);

    return view('users.viewComments')->with('comments',$comments);
}
}
