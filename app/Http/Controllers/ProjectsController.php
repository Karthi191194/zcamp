<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Redirect;

use DB;


class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
//projects - list
    public function projects_list(){
        $projects = Project::paginate(3);
        return view('backend.projectslist', compact('projects'));
    }

    public function project($id = null){
        if(isset($id)){
            $project = Project::find($id)->toArray();
            return view('backend.project', compact('project'));
        }else {
            return view('backend.project');
        }
    }
//new project - insert form 2
    public function store(Request $request){
        $project = new Project;
        $project->project_name = $request->project_name;
        $project->project_members = $request->project_members;
        $project->project_credentials = $request->project_credentials;

        if($project->save()){
            $request->session()->flash('alert-success','Project created successfully!');
        }else{
            $request->session()->flash('alert-error','Error occurred while creating project. Please try again.');
        }

       return Redirect::back();
    }

    public function update(Request $request, $id){
        $project = Project::find($id);
        $project->project_name = $request->project_name;
        $project->project_members = $request->project_members;
        $project->project_credentials = $request->project_credentials;

        if($project->save()){
            $request->session()->flash('alert-success','Project updated successfully!');
        }else{
            $request->session()->flash('alert-error','Error occurred while updating project. Please try again.');
        }

        return Redirect::back();
    }

    public function delete($id){
        $project = Project::find($id);
        $project->delete();
        return Redirect::back();
    }
//ajax pagination
    public function pagination(Request $request){

        if($request->ajax()){
            $projects = Project::paginate(3);
            return view('backend.pagination_data', compact('projects'))->render();
        }
    }
//multi delete
    public function bulkdelete(Request $request){
        $selected_ids = $request -> projects_checked;
        if(Project::whereIn('id', $selected_ids )->delete()){
            echo "Success";
        }else{
            echo "Failure";
        }
    }

//learning autocomplete
    public function autocomplete(){
        return view('backend.autocomplete');
    }

    public function autocompletefetch(Request $request){
            $query = $request -> autocompletequery;
           // echo "<pre>"; print_r($query);
       $a =  Project::where('project_name', $query)
            ->orWhere('project_name', 'like', '%' . $query . '%')->get();
        dd(DB::getQueryLog());
       echo "<pre>"; print_r($a);

    }
}
