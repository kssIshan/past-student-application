<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sport\SportAttachRequest;
use App\Http\Requests\Sport\SportSaveRequest;
use App\Http\Requests\Sport\SportUpdateRequest;
use App\Models\Achievement;
use App\Models\Sport;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SportController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(int $studentId)
    {
        try {
            $sportId = [];
            $sportStudentDetails = [];
            DB::beginTransaction();
            $student = Student::with('sports')->findOrFail($studentId);
            //$studentSports = $student->sports()->with('Sport')->get();
            //dd($studentSports);
            if ($student === null) {
                return " no user Found";
                //abort(404, 'User not found');
                //or 404 error  
            } else {
                //dd($student->sports);
                foreach ($student->sports as $sport) {
                    $sportId[] = $sport->id;
                    $sportStudentDetails = DB::select('select * from sport_student 
                     where student_id=?', [$studentId]);

                    // $sportStudentDetails = DB::table('sport_student')
                    //     ->join('sport', 'sport_student.sport_id', '=', 'sport.id')
                    //     ->select('sport_student.*', 'sport.*') // Select desired columns
                    //     ->where('student_id', $studentId)
                    //     ->get();
                }
                $sportList = Sport::all();
                //$achievements = DB::select('select * from achievements where student_id=?', [$studentId]);
                $achievements = Achievement::where('student_id', $studentId)->get();

                //dd($sportStudentDetails);
                //dd($sportId);
                return Inertia::render("Sport/SportAndAchievements", ['achievements' => $achievements, 'student' => $student, 'sports' => $sportStudentDetails, 'sportList' => $sportList]);

                //abort(404, 'User not found');
                //return "user Found";
                //or 404 error 
                //$message = $responce->message();
            }

            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        //dd($student);
        // $achievements = [];
        // $sports = $student->sport;
        // foreach ($sports as $sport) {
        // }
        //return Inertia::render("Sport/SportAndAchievements", ['sports' => $sports, 'achievements' => $achievements, 'student' => $student]);
    }

    /**
     * Show the form for creating a new resource.
     */
    /*public function create(int $studentId)
    {
        $student = Student::findOrFail($studentId);
        $sports = Sport::all();
        return Inertia::render("Sport/AddSport", ['student' => $student, 'sports' => $sports]);
    }*/


    /**
     * Store a newly created resource in storage.
     */
    public function store(SportSaveRequest $request, int $studentId)
    {
        $validatedRequest = $request->validated();
        Sport::create([
            'sport_name' => $validatedRequest['sport_name']
        ]);
        return redirect()->route('sport.index', [$studentId]);
    }
    public function attachSport(SportAttachRequest $request, int $studentId)
    {
        try {
            DB::beginTransaction();
            $student = Student::FindOrFail($studentId);
            $validatedRequest = $request->validated();
            $sport_id = $validatedRequest['sport_id'];
            $existingSport = $student->sports()->wherePivot('sport_id', $sport_id)->exists();
            if (!$existingSport) {
                $attachSport = [
                    // 'student_id' => $validatedRequest['student_id'],
                    // 'sport_id' => $validatedRequest['sport_id'],
                    'period' => $validatedRequest['period']
                ];
                $student->sports()->attach($sport_id, $attachSport);
                // Sport::create([
                //     'sport_name' => $validatedRequest['sport_name']
                // ]);
                DB::commit();
                return redirect()->route('sport.index', [$studentId])->with('success', 'Sport attached successfully.');
            } else {
                return "Previously added sport";
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }
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
    public function edit(int $studentId, int $sportId)
    {
        // Find the student
        $student = Student::findOrFail($studentId);

        // Load the sports associated with the student using the pivot table
        //$sports = $student->sports()->get();
        $sport = $student->sports()->wherePivot('sport_id', $sportId)->first();

        if ($sport) {
            // Sport found
            // Access the sport object
            return response()->json([$sport], 201);
        } else {
            return "no details";
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $studentId, int $sportId, SportUpdateRequest $request)
    {
        //dd($request);
        //dd($sportId);
        $validatedRequest = $request->validated();
        $sport_id = $validatedRequest['sport_id'];
        //dd($sport_id);
        // $sport=Sport::FindOrFail($sport_id);
        $student = Student::findOrFail($studentId);

        $sport = $student->sports()->wherePivot('sport_id', $sportId)->first();
        //dd($sport);
        log::alert($sport);
        // Check if the sport is already attached
        $existingSport = $student->sports()->wherePivot('sport_id', $sport_id)->exists();
        //dd($existingSport);
        log::alert($existingSport);
        if (!$existingSport) {
            // Detach any existing sport
            $student->sports()->detach($sportId);

            // Attach the new sport
            $attachSport = [
                'period' => $validatedRequest['period']
            ];
            $student->sports()->attach($sport_id, $attachSport);

            return response()->json([$attachSport], 201);
        } else {
            return "previously attached";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $studentId, int $sportId)
    {
        // Find the student by ID
        $student = Student::findOrFail($studentId);

        // Find the sport by ID
        $sport = Sport::findOrFail($sportId);

        // Detach the sport from the student's sportStudent relationship
        $student->sports()->detach($sport);

        // Optionally, you can return a response or redirect
        // return response()->json(['message' => 'Sport removed from student successfully']);

        return redirect()->route('sport.index', [$studentId]);
    }
}
