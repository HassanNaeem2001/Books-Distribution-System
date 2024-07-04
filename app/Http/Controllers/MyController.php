<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\bookstatus;
class MyController extends Controller
{
    //
    public function getbatches(){
        $batches = DB::table('batches')->get();
        $semesters = DB::table('semesters')->get();
        $curriculums = DB::table('curricula')->get();
        return View('welcome',compact(['batches','semesters','curriculums']));
    }
    public function getsem(Request $req){
       
        $sem = $req->post('SemId');
        $batch = $req->post('BatchId');

        $curr = DB::table('batches')->where('id', $batch)->value('Curr_ID');
        // echo $curr;
        // echo $sem;

        
        $skills = DB::table('curricula')->
        join('skills','curricula.id','=','skills.Curr_ID')->
        where('skills.Curr_ID',$curr)->
        where('skills.Sem_ID',$sem)->
        get('skills.Skill');

        
        $batchstudents = DB::table('students')->where('students.Batch_ID',$batch)->get();
        $html = '<table class="table table-striped table-responsive">';
        $html .= '<tr><th>StudentID</th><th>StudentName</th>';
        foreach ($skills as $s) {
            $html .= "<th>$s->Skill</th>";
        }
        $html .= '</tr>'; 
        foreach($batchstudents as $bs)
        {
            $html .="<tr>";
            $html .= "<td>".$bs->Std_id."</td>";
            $html .= "<td>".$bs->Std_Name."</td>";
            $studentwithskill = DB::table('bookstatuses')
            ->where('StudentId', $bs->Std_id)
            ->pluck('Status', 'SkillName');
            foreach($skills as $s){
                $isChecked = $studentwithskill->has($s->Skill) && $studentwithskill[$s->Skill] === 'Given' ? 'checked' : '';
                $html.="<td><input type='checkbox' id='skillcheck' data-studentid='".$bs->Std_id."' data-skill='$s->Skill' $isChecked></td>";
            }
        }
        return $html;
        
    }
    public function changestatus(Request $req){
        $stdid = $req->post('studentid');
        $skill = $req->post('skill');
        $status = $req->post('status');

        $rec = new bookstatus();
        $rec->StudentId = $stdid;
        $rec->SkillName = $skill;
        $rec->Status = $status;
        $rec->save();

    }
   
}
