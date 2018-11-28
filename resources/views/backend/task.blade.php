@extends('backend.layout.dashboard')

@section('content')
   <!-- <form method="post" action="task-insert"> -->
        {{ csrf_field() }}
        <div class="form-group">
            <label for="task-name">Task Name</label>
            <input type="text" name="task_name" class="form-control" id="task-name" REQUIRED>
        </div>
        <div class="form-group">
            <label for="task-description">Task Description</label>
            <textarea name="task_description" class="form-control" id="task-description"></textarea>
        </div>
        <button type="submit" name="task_submit" class="btn btn-default" onclick="addTask();">ADD TASK</button>
    <!-- </form> -->
 <script>
     function addTask() {
         
     }
 </script>   
@endsection