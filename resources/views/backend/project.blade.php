@extends('backend.layout.dashboard')

@section('content')
    {{--new project insert form 1 --}}
    @if (Session::has('alert-success'))
    <div class="alert alert-success">
        {{ Session::get('alert-success') }}
    </div>
    @elseif (Session::has('alert-error'))
    <div class="alert alert-danger">
        {{ Session::get('alert-error') }}
    </div>
    @endif

<!--<form  method="post" action="{{-- url('project') --}}">
            {{-- csrf_field()--}}
            <div class="form-group">
                <label for="project-name" style="font-weight:100;">Name this project</label>
                <input type="text" name="project_name" class="form-control" id="project-name"  required>
            </div>
            <div class="form-group">
                <label for="project-members" style="font-weight:100;">Add Project Members</label>
                <textarea name="project_members" class="form-control" id="project-members" required></textarea>
            </div>
            <div class="form-group">
                <label for="project-credentials" style="font-weight:100;">Add Project Credentials</label>
                <textarea name="project_credentials" class="form-control" id="project-credentials" rows="10" required></textarea>
            </div>

            <button type="submit" name="project_new" class="btn btn-default" value="save" style="color: #aaabae;background-color: #303641;" >SAVE</button>
</form> -->
   {{-- using same form for creating and updating --}}
{{-- Project on line 34, 35 is the value sent from the view--}}
@if(isset($project))
    {{ Form::model($project, ['url' => ['project-update', $project['id']], 'method' => 'patch']) }}
@else
    {{ Form::open(array('url' => 'project')) }}
@endif
    <div class="form-group">
        {{ Form::label('project_name', 'Name this project') }}
        {{ Form::text('project_name', null, array('class' => 'form-control','required' => 'required')) }}
    </div>
    <div class="form-group">
        {{ Form::label('project_members', 'Add Project Members') }}
        {{ Form::textarea('project_members',null, array('class' => 'form-control','required' => 'required','rows' => 3)) }}
    </div>
    <div class="form-group">
        {{ Form::label('project_credentials', 'Add Project Credentials') }}
        {{ Form::textarea('project_credentials',null, array('class' => 'form-control','required' => 'required', 'rows' => 10)) }}
    </div>
    {{ Form::submit('SAVE', array('class' => 'btn btn-default', 'name' => 'project_save')) }}
{{ Form::close() }}
@endsection
