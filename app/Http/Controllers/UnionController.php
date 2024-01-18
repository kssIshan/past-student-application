<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectAttachRequest;
use App\Http\Requests\Union\UnionSaveRequest;
use App\Models\Student;
use App\Models\Union;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $studentId)
    {
        $student = Student::with('unions')->findOrFail($studentId);
        $unions = $student->unions;

        return Inertia::render("Union/UnionDetails", ['unions' => $unions, 'student' => $student]);
    }



    /**
     * Show the form for creating a new resource.
     */

    //Add new project to a union of a particular student
    public function create(int $studentId, int $unionId)

    {
        //$projects = [];
        $union = Union::with('projects')->findOrFail($unionId);
        //$student = Student::findOrFail($studentId);

        return Inertia::render("Union/AddNewUnionProjectDetails", ['union' => $union, 'studentId' => $studentId]);
        //return Inertia::render("Union/AddNewUnionProjectDetails");
    }

    /**
     * Store a newly created resource in storage.
     * store a union to the system
     */
    public function store(UnionSaveRequest $request)
    {
        //dd($request);
        $validatedRequest = $request->validated();
        $studentId = $validatedRequest['studentId'];
        // Union::create([
        //     'name' => $request->input('name'),
        //     'start_date' => $request->input('start_date'),
        //     'status' => $request->input('status'),
        // ]);
        Union::create([
            'name' => $validatedRequest['name'],
            'start_date' => $validatedRequest['start_date'],
            'status' => $validatedRequest['status'],
        ]);
        return redirect()->route('unionProject.create', $studentId);
        // return response()->json(['comments' => $studentId]);
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
    public function destroy(int $studentId, int $unionId)
    {
        // $studentUnion = DB::select('select * from student_union 
        // where student_id=? and union_id=?', [$studentId, $unionId]);

        $deleted = DB::table('student_union')->where([
            ['student_id', '=', $studentId],
            ['union_id', '=', $unionId],
        ])->delete();
        //return response()->json(['Deleted' => $deleted]);
    }
}
