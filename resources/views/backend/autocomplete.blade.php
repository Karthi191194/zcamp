@extends("backend.layout.dashboard")

@section('content')
    <form>
        <div class="col-md-6 pad-left-0 form-group">
            <input type="text" class="form-control" name="autocomplete_text" id="autocomplete-text" placeholder="Enter Project Name">
            <div id="project-list"></div>
        </div>
        {{ csrf_field() }}
    </form>

    <script>
        $(document).ready(function(){
            $("#autocomplete-text").keyup(function(){
                var query = $(this).val();
                if(query != ''){
                    //console.log(query);
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "autocomplete-fetch",
                        method: "POST",
                        data: {autocompletequery:query, _token:_token},
                        success: function(response){
                            //console.log(response);
                            $("#project-list").fadeIn();
                            $("#project-list").html(response);
                        }
                    });
                }
            });
        });
    </script>
@endsection