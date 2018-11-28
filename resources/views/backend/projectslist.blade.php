@extends('backend.layout.dashboard')

@section('content')
<div id="projectdetails">
<div class="row"  id="p-details" style="margin-bottom: 10px;">
<div class="col-md-6"><strong>Projects</strong> ({{ $projects->total( ) }})</div>
<div class="col-md-3"><a href="{{ url('project') }}" class="btn btn-default">Add New Project</a></div>
<div class="col-md-3"><a href="#" id="project-delete" class="btn btn-default">Bulk Delete</a></div>
</div>
<div class="row">
<div class="col-md-12">
<!--
<table class="table table-striped">
    <tr>
        <th style="font-weight: 100; font-size: 14px;">PROJECT NAME</th>
        <th style="font-weight: 100; font-size: 14px;">UPDATE</th>
        <th style="font-weight: 100; font-size: 14px;">DELETE</th>
    </tr>
    {{-- @foreach($projects as $project)
     <tr>
        <td>{{  $project -> project_name }}</td>
        <td><a href="{{ url('project').'/'.$project -> id }}" class="btn btn-warning">Update</a></td>
        <td><a href="{{ url('project-delete').'/'.$project -> id }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
     </tr>
    @endforeach
</table>

    {{ $projects->links() }} --}}
-->

<!-- ajax pagination -->
    <div id="table_data">
        @include('backend.pagination_data')
    </div>
<!-- ajax pagination -->

<script>
    $(document).ready(function(){
        $(document).on('click','.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr("href").split("page=")[1];
            fetch_data(page);
        });

        function fetch_data(page){
            $.ajax({
                url: "project-pagination?page="+page,
                success: function(response){
                    $("#table_data").html(response);
                }
            });
        }
<!-- multi delete -->
        $(document).on("click","#project-delete", function(event){
            event.preventDefault();

            if(confirm("Are you sure you want to delete the selected projects?")){
                var projects_checked = [];

                $(".project-delete:checked").each(function(i){
                    projects_checked[i] = $(this).val();
                });

                //if no checkboxes selected
                if(projects_checked.length == 0){
                    alert("Please select atleast one project to delete");
                }else{
                    $.ajax({
                        url: "projects-delete",
                        method: "POST",
                        data: {projects_checked : projects_checked , _token: '{{csrf_token()}}'},
                        success: function(response){
                            $("#projectdetails").empty();
                            $("#projectdetails").load(location.href +  ' #projectdetails');
                            //location.reload();
                                alert("The selected projects are deleted");
                        }
                    });
                }

            }else{
                return false;
            }

        });

    });
</script>
</div>
</div>
</div>
@endsection

<!--
$( "#result" ).load( "ajax/test.html #container" );

When this method executes, it retrieves the content of ajax/test.html,
but then jQuery parses the returned document to find the element with an ID of container.
This element, along with its contents, is inserted into the element with an ID of result,
and the rest of the retrieved document is discarded.
-->