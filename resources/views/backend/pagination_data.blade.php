@if(count($projects))
<table class="table table-striped">
    <tr>
        <th style="font-weight: 100; font-size: 14px;">#</th>
        <th style="font-weight: 100; font-size: 14px;">PROJECT NAME</th>
        <th style="font-weight: 100; font-size: 14px;">UPDATE</th>
        <th style="font-weight: 100; font-size: 14px;">DELETE</th>
    </tr>
 @foreach($projects as $project)
 <tr>
    <td><input type="checkbox" name="project_delete[]" class="project-delete" value="{{ $project -> id }}"></td>
    <td>{{  $project -> project_name }}</td>
    <td><a href="{{ url('project').'/'.$project -> id }}" class="btn btn-warning">Update</a></td>
    <td><a href="{{ url('project-delete').'/'.$project -> id }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
 </tr>
@endforeach
</table>

{{ $projects->links() }}
@else
    <div class="alert alert-info text-center">
        No projects found!
    </div>
@endif