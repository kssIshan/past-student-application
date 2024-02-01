<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectAttachRequest;
use App\Http\Requests\Project\ProjectSaveRequest;
use App\Models\Project;
use App\Models\Student;
use App\Models\Union;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($unionId)
    {
        //$projects = Union::all();
        //$projects  = Project::findOrFail($unionId);
        $union = Union::with('projects')->findOrFail($unionId);
        $projects = $union->projects;

        /* $projects = DB::select('
    SELECT project_union.*, projects.name
    FROM project_union
    JOIN projects ON project_union.project_id = projects.id
    WHERE project_union.union_id = ?', [$unionId]);*/

        return response()->json(['projects' => $projects]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectSaveRequest $request)
    {
        //dd($request);
        $valicdtedData = $request->validated();
        //$studentId = $student->id;
        $unionId = $valicdtedData['union_id'];;
        $studentId = $valicdtedData['student_id'];
        //dd($unionId);
        $project = Project::create([
            'name' => $valicdtedData['name'],
            'status' => $valicdtedData['status'],
            'duration' => $valicdtedData['duration'],
            'description' => $valicdtedData['description'],
            'start_date' => $valicdtedData['start_date'],
            'end_date' => $valicdtedData['end_date'],
        ]);
        //laravel looking for project_union table there fore i 
        //Cannot use attach() 
        $project->unions()->attach($unionId);
        //dd($project);
        return redirect()->route('unionProject.create', $studentId);
        //return response()->json('success');
    }

    public function attachProject(ProjectAttachRequest $request, int $studentId, int $unionId)
    {
        //dd($request);
        $validatedRequest = $request->validated();
        $projectId = $validatedRequest['project_id'];
        //dd($projectId);
        //$projectId = $request->project_id;
        $student = Student::findOrFail($studentId);
        $unions = $student->unions;
        //dd($unions);
        foreach ($unions as $union) {
            if ($union['id'] == $unionId) {
                //$projectIds = DB::select('select projec_id from project_union where priject_id=?', [$projectId]);
                $projectUnionIdRow = DB::selectOne('select id from project_union where project_id=?', [$projectId]);

                $projectUnionId = $projectUnionIdRow->id;
                $checkProjectUnionIdRow = DB::selectOne('select id from student_union_project where student_id=? and project_union_id=?', [$studentId, $projectUnionId]);
                //dd($checkProjectUnionIdRow);
                //$checkProjectUnionId = $checkProjectUnionIdRow->id;
                //prevent duplicate by checking availability of database student_union_project
                if ($checkProjectUnionIdRow === null) {
                    //dd($projectUnionId);
                    if ($projectUnionId != null) {
                        DB::insert('insert into student_union_project (student_id, project_union_id)
                     values (?, ?)', [$studentId, $projectUnionId]);
                    } else {
                        //if the project do not belogs to considered union
                    }
                } else {
                    ///avoid duplicate
                }
            } else {
                //// union{['id']  is not eqaul to unionId
            }
        }
        //return response()->json('success');
        //return redirect()->route('dashboard');
        //with('status', 'Project attached successfully')->status(303)
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
