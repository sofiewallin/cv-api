<?php

namespace App\Http\Controllers;

use App\Models\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all work experiences
        return WorkExperience::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'role' => 'required|string|min:2|max:64',
            'workplace' => 'nullable|string|max:64',
            'workplace_website' => 'nullable|string|url|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'order' => 'required|integer|min:0'
        ]);

        // Create and return work experience
        return WorkExperience::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find work experience
        $work_experience = WorkExperience::find($id);

        // Return error message if no work experience with the given id
        if (!$work_experience) {
            return response([
                'message' => 'There is no work experience matching the given id.'
            ], 404);
        }

        // Validate request
        $request->validate([
            'role' => 'sometimes|required|string|min:2|max:64',
            'workplace' => 'nullable|string|max:64',
            'workplace_website' => 'nullable|string|url|max:255',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'nullable|date',
            'order' => 'sometimes|required|integer|min:0'
        ]);
        
        // Update work experience
        $work_experience->update($request->all());
        
        // Return work experience
        return $work_experience;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find work experience
        $work_experience = WorkExperience::find($id);

        // Return error message if no work experience with the given id
        if (!$work_experience) {
            return response([
                'message' => 'There is no work experience matching the given id.'
            ], 404);
        }

        // Delete work experience
        $work_experience->delete();
        
        // Return work experience
        return $work_experience;
    }
}
