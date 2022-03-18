<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    // Project types
    private $types = ['Professional', 'Student', 'Personal'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all projects
        return Project::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_data = $request->all();

        // Validate request
        $validator = Validator::make($request_data, [
            'title' => 'required|string|min:2|max:64',
            'website' => 'nullable|string|url|max:255',
            'description' => 'nullable|string',
            'logo' => 'required|file|image|mimes:svg',
            'type' => [
                'required',
                Rule::in($this->types) // Only specific types allowed
            ],
            'order' => 'required|integer|min:0'
        ])->validate();

        // Handle image
        if ($request->hasFile('logo')) {
            // Original file
            $file = $request->file('logo');

            // Create unique file
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_extension = $file->getClientOriginalExtension();
            $new_image = str_replace(' ', '_', $file_name).'_'.rand().'_'.time().'.'.$file_extension;
            
            // Store file  
            $file->storeAs('public/uploads', $new_image);
            Storage::setVisibility($new_image, 'public');

            $request_data['logo'] = $new_image;
        }

        // Create project
        $project = Project::create($request_data);

        // Return created project
        return $project;
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
        // Find project
        $project = Project::find($id);

        // Return error message if no project with the given id
        if (!$project) {
            return response([
                'message' => 'There is no project matching the given id.'
            ], 404);
        }

        $request_data = $request->all();

        // Validate request
        $validator = Validator::make($request_data, [
            'title' => 'sometimes|required|string|min:2|max:64',
            'website' => 'nullable|string|url|max:255',
            'description' => 'nullable|string',
            'logo' => 'sometimes|required|file|image|mimes:svg',
            'type' => [
                'sometimes',
                'required',
                Rule::in($this->types) // Only specific types allowed
            ],
            'order' => 'sometimes|required|integer|min:0'
        ])->validate();
        
        // Handle image
        if ($request->hasFile('logo')) {
            // Original file
            $file = $request->file('logo');

            // Create unique file
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_extension = $file->getClientOriginalExtension();
            $new_image = str_replace(' ', '_', $file_name).'_'.rand().'_'.time().'.'.$file_extension;
            
            // Store file  
            $file->storeAs('public/uploads', $new_image); 

            $request_data['logo'] = $new_image;
        }

        // Update project
        $project->update($request_data);
        
        // Return updated project
        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find project
        $project = Project::find($id);

        // Return error message if no project with the given id
        if (!$project) {
            return response([
                'message' => 'There is no project matching the given id.'
            ], 404);
        }

        // Delete project
        $project->delete();
        
        // Return project
        return $project;
    }
}
