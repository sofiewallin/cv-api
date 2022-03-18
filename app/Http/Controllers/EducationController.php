<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EducationController extends Controller
{
    // Education types
    private $types = ['Program', 'Course'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all education
        return Education::all();
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
            'name' => 'required|string|min:2|max:64',
            'degree' => 'nullable|string|max:255',
            'institution' => 'required|string|min:2|max:64',
            'institution_website' => 'nullable|string|url|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'type' => [
                'required',
                Rule::in($this->types) // Only specific types allowed
            ],
            'order' => 'required|integer|min:0'
        ])->validate();
        
        // Create and return education
        return Education::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find education
        $education = Education::find($id);

        // Return error message if no education with the given id
        if (!$education) {
            return response([
                'message' => 'There is no education matching the given id.'
            ], 404);
        }

        // Return education
        return $education;
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
        // Find education
        $education = Education::find($id);

        // Return error message if no education with the given id
        if (!$education) {
            return response([
                'message' => 'There is no education matching the given id.'
            ], 404);
        }

        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|min:2|max:64',
            'degree' => 'nullable|string|max:255',
            'institution' => 'sometimes|required|string|min:2|max:64',
            'institution_website' => 'nullable|string|url|max:255',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'nullable|date',
            'type' => [
                'sometimes',
                'required',
                Rule::in($this->types) // Only specific types allowed
            ],
            'order' => 'sometimes|required|integer|min:0'
        ])->validate();
        
        // Update education
        $education->update($request->all());
        
        // Return education
        return $education;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find education
        $education = Education::find($id);

        // Return error message if no education with the given id
        if (!$education) {
            return response([
                'message' => 'There is no education matching the given id.'
            ], 404);
        }

        // Delete education
        $education->delete();
        
        // Return education
        return $education;
    }
}
