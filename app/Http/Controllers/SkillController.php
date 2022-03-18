<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    // Skill types
    private $types = ['Professional', 'Technical', 'Personal', 'Lingual'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all skills
        return Skill::all();
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:2|max:64',
            'type' => [
                'required',
                Rule::in($this->types) // Only specific types allowed
            ],
            'order' => 'required|integer|min:0'
        ])->validate();
        
        // Create and return skill
        return Skill::create($request->all());
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
        // Find skill
        $skill = Skill::find($id);

        // Return error message if no skill with the given id
        if (!$skill) {
            return response([
                'message' => 'There is no skill matching the given id.'
            ], 404);
        }

        // Validate request
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|min:2|max:64',
            'type' => [
                'sometimes',
                'required',
                Rule::in($this->types)
            ],
            'order' => 'sometimes|required|integer|min:0'
        ])->validate();
        
        // Update skill
        $skill->update($request->all());
        
        // Return skill
        return $skill;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find skill
        $skill = Skill::find($id);

        // Return error message if no skill with the given id
        if (!$skill) {
            return response([
                'message' => 'There is no skill matching the given id.'
            ], 404);
        }

        // Delete skill
        $skill->delete();
        
        // Return skill
        return $skill;
    }
}
