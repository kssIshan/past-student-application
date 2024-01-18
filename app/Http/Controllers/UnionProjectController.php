<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectAttachRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Http\Requests\Union\StudentUnionSaveRequest;
use App\Http\Requests\union\StudentUnionUpdateRequest;
use App\Models\Project;
use App\Models\Student;
use App\Models\Union;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class UnionProjectController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index(int $studentId, int $unionId)
    {

        $projects = [];
        $union = Union::findOrFail($unionId);
        //dd($studentId);
        //dd($unionId);
        $student = Student::findOrFail($studentId);
        //dd($student);
        try {
            DB::beginTransaction();
            $results = DB::select('select project_union_id from 
            student_union_project where student_id=?', [$studentId]);
            //dd($results);
            if (!empty($results)) {
                foreach ($results as $result) {
                    $unionProjectId = $result->project_union_id;
                    $projectIds = DB::select('select project_id from project_union 
                    where id=? and union_id=? ', [$unionProjectId, $unionId]);

                    //dd($projectIds);

                    //no need of this loop one value of project_id contain in $projectIds
                    //because in project_union table  different id do not have 
                    //same project_id and union_id at same time
                    foreach ($projectIds as $projectIdObj) {
                        //dd($projectIdObj);
                        //$projectId = $projectIdObj['project_id'];
                        $projectId = $projectIdObj->project_id;

                        $project = Project::findOrFail($projectId);
                        //dd($project);
                        $projects[] = $project;
                    }
                }
                return Inertia::render("Union/UnionProjectDetails", ['projects' => $projects, 'union' => $union, 'student' => $student]);
            }
            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Transaction Failed' . $e->getMessage());
        }

        //return Inertia::render("Union/UnionProjectDetails", ['projects' => $projects, 'union' => $union, 'student' => $student]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $studentId)
    {
        //use this in select union field and select project field
        //you have to create add union and program
        //$unions =Union::all();
        //$projects = Project::all();
        $unions = Union::all();
        //$unions = Union::with('projects')->get();

        $projects = Project::all();
        $student = Student::findOrFail($studentId);
        return Inertia::render("Union/AddUnionStudent", ['student' => $student, 'unions' => $unions, 'projects' => $projects]);
    }



    /**
     * Store a newly created resource in storage.
     * store union and program for student
     */
    public function store(StudentUnionSaveRequest $request, Student $student)
    {
        //dd($request);
        //{"union_id":1,"position":"precident","duration":"4 months",
        //"join_date":"2024-01-08","leave_date":"2024-01-25",
        //"unionProjects":[{"project_id":2},{"project_id":23}]}
        $valicdtedData =  $request->validated();
        //dd($valicdtedData);
        $studentId = $student->id;


        $unionId = $valicdtedData['union_id'];
        $unionProjectId = [];

        //$union = Union::findOrFail($unionId);
        //dd($union);
        $newStudentUnion = [
            'position' => $valicdtedData['position'],
            'duration' => $valicdtedData['duration'],
            'join_date' => $valicdtedData['join_date'],
            'leave_date' => $valicdtedData['leave_date'],


        ];
        $student->unions()->attach($unionId, $newStudentUnion);
        //dd($newStudentUnion);
        $projectArray = $valicdtedData['unionProjects'];
        //dd($projectArray);
        if ($projectArray !== null) {
            foreach ($projectArray as  $result) {
                $studentId = (int)$studentId;

                //dd($result['project_id']);
                //check the retrived array they carry null values there fore it throw 
                //error when exam saved without values. so i used if statement to save results
                if ($result['project_id'] !== null) {
                    $projectId = $result['project_id'];
                    //dd($projectId);


                    $unionProjectIdRow = DB::selectOne('select id from project_union 
                    where project_id = ? and union_id=?', [$projectId, $unionId]);
                    //dd($unionProjectIdRow);
                    $unionProjectId = $unionProjectIdRow->id;
                    $checkUnionProjectIdRow = DB::selectOne('select id from student_union_project 
                    where student_id=? and project_union_id=?', [$studentId, $unionProjectId]);

                    if ($checkUnionProjectIdRow !== null) {
                        $checkUnionProjectId = $checkUnionProjectIdRow->id;
                        // Use $checkUnionProjectId as needed
                    } else {
                        // Handle the case where no row is found
                        $checkUnionProjectId = null;
                    }
                    if ($checkUnionProjectId == null) {
                        //dd($unionProjectId);
                        if (($unionProjectId) != null) {

                            DB::insert('insert into student_union_project (student_id, project_union_id)
                         values (?, ?)', [$studentId, $unionProjectId]);

                            // $student->projects()->attach($unionProjectId, $newStudentUnionProject);
                        }
                    } else {
                        //
                    }
                }
                //dd($unionProjectId);
            }
        } else {
            //
        }
        $student->unions()->attach($unionId, $newStudentUnion);

        //$student->programs()->attach($request->programs);
        return redirect()->route('unionProject.create', $studentId);
    }




    /**
     *  Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $studentId, int $unionId)
    {
        $unions = Union::all();
        $union = Union::findOrFail($unionId);
        $studentUnion = DB::selectOne('select * from student_union where union_id=?', [$unionId]);
        //dd($studentUnion);

        //$projects = Project::all();
        $projects = [];
        $arrayaUnionaProjects = [];
        $unionProjects = [];
        $student = Student::findOrFail($studentId);
        $studentUnionProjects = DB::select('select * from student_union_project 
        where student_id=?', [$studentId]);
        //dd($studentUnionProjects);

        foreach ($studentUnionProjects as $studentUnionProject) {
            $studentUnionProjectId = $studentUnionProject->project_union_id;
            $unionProject = DB::selectOne('select * from project_union
             where id=? and union_id=? ', [$studentUnionProjectId, $unionId]);

            $unionProjects[] = $unionProject;
        }
        //dd($unionProjects);
        if ($unionProjects != null) {
            foreach ($unionProjects as $project) {
                if ($project != null) {
                    $arrayaUnionaProjects[] = $project;
                    //$projectId = $project->id;

                    // Assuming you want to fetch the project from the database based on the ID
                    //$projectFromDB = DB::select('select * from projects where id=?', [$projectId]);

                    /* if ($projectFromDB != null) {
                        $arrayaUnionaProjects[] = $projectFromDB;
                    } else {
                        // Handle the case where the project couldn't be retrieved from the database
                        // You may want to log an error or take other appropriate action
                    }*/
                } else {
                    // Handle the case where $project is null
                    // You may want to log an error or take other appropriate action
                }
            }
        }
        //dd($arrayaUnionaProjects);
        foreach ($arrayaUnionaProjects as $project) {
            $projectId = $project->project_id;

            // Assuming you want to fetch the project from the database based on the ID
            $projectFromDB = DB::selectOne('select * from projects where id=?', [$projectId]);

            $projects[] = $projectFromDB;
        }
        //dd($projects);


        return Inertia::render("Union/EditUnionStudent", ['studentUnion' => $studentUnion, 'student' => $student, 'union' => $union, 'unions' => $unions, 'projectsArray' => $projects]);
        //return Inertia::render("Union/EditUnionStudent");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUnionUpdateRequest $request, int $studentId, int $unionId)
    {
        //dd($request);
        $valicdtedData =  $request->validated();
        $student = Student::findOrFail($studentId);

        $union_id = $valicdtedData['union_id'];
        $unionProjectId = [];
        $checkStudentUnion = DB::select('select * from student_union
             where student_id=? and union_id=?', [$studentId, $unionId]);
        $student->unions()->detach($unionId, $checkStudentUnion);
        $newStudentUnion = [
            'position' => $valicdtedData['position'],
            'duration' => $valicdtedData['duration'],
            'join_date' => $valicdtedData['join_date'],
            'leave_date' => $valicdtedData['leave_date'],
        ];
        if ($unionId == $union_id) {

            $student->unions()->attach($unionId, $newStudentUnion);
            $projectArray = $valicdtedData['unionProjects'];
            //dd($projectArray);
            if ($projectArray !== null) {
                foreach ($projectArray as  $result) {
                    $studentId = (int)$studentId;

                    //dd($result['project_id']);
                    //check the retrived array they carry null values there fore it throw 
                    //error when exam saved without values. so i used if statement to save results
                    if ($result['project_id'] !== null) {
                        $projectId = $result['project_id'];
                        //dd($projectId);


                        $unionProjectIdRow = DB::selectOne('select id from project_union 
                        where project_id = ? and union_id=?', [$projectId, $unionId]);
                        //dd($unionProjectIdRow);
                        $unionProjectId = $unionProjectIdRow->id;
                        $checkUnionProjectIdRow = DB::selectOne('select id from student_union_project 
                        where student_id=? and project_union_id=?', [$studentId, $unionProjectId]);

                        if ($checkUnionProjectIdRow !== null) {
                            $checkUnionProjectId = $checkUnionProjectIdRow->id;
                            // Use $checkUnionProjectId as needed
                        } else {
                            // Handle the case where no row is found
                            $checkUnionProjectId = null;
                        }
                        if ($checkUnionProjectId == null) {
                            //dd($unionProjectId);
                            if (($unionProjectId) != null) {

                                DB::insert('insert into student_union_project (student_id, project_union_id)
                             values (?, ?)', [$studentId, $unionProjectId]);

                                // $student->projects()->attach($unionProjectId, $newStudentUnionProject);
                            }
                        } else {
                            //
                        }
                    }
                    //dd($unionProjectId);
                }
            }
        } elseif ($unionId !== $union_id) {

            $student->unions()->attach($union_id, $newStudentUnion);
            $UnionrPojectsIds = Db::select('select id from project_union 
            where union_id=?', [$unionId]);
            $studentUnionrPojectsIds = Db::select('select project_union_id from 
            student_union_project where student_id=?', [$studentId]);
            //dd($UnionrPojectsIds);
            foreach ($UnionrPojectsIds as $UnionProjectsId) {
                foreach ($studentUnionrPojectsIds as $studentUnionrPojectsId) {
                    // Cast the objects to arrays
                    $UnionProjectsIdArray = (array) $UnionProjectsId;
                    $studentUnionrPojectsIdArray = (array) $studentUnionrPojectsId;
                    if ($UnionProjectsIdArray['id'] == $studentUnionrPojectsIdArray['project_union_id']) {
                        $deleted = DB::table('student_union_project')->where([
                            ['student_id', '=', $studentId],
                            ['project_union_id', '=', $studentUnionrPojectsIdArray['project_union_id']],
                        ])->delete();
                    }
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $studentId, int $unionId, int $projectId)
    {
        $projectUnionIdRow = DB::selectOne('select id from project_union 
         where union_id=? and project_id=?', [$unionId, $projectId]);
        $projectUnionId = $projectUnionIdRow->id;
        $deleted = DB::table('student_union_project')->where([
            ['student_id', '=', $studentId],
            ['project_union_id', '=', $projectUnionId],
        ])->delete();
        return redirect()->route('unionProject.create', $studentId);
    }
}
