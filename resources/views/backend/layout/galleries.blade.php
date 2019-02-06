<!DOCTYPE html>
<html lang="en">
<head>
    <title>Image gallery with Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Listing Images</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                @if (Session::has('alert-success'))
                    <div class="alert alert-success">
                        {{ Session::get('alert-success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data"  class="form-inline">
                    <p><small>Note: Total size of uploading files shold not be greater than 8 MB.</small></p>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image[]"  accept="image/png, image/jpeg, image/jpg, image/gif"  class="form-control" multiple/>
                        <input type="text" name="title" placeholder="Image description (Optional)" class="form-control"/>
                        <select name="status" class="form-control">
                            <option value="1">Publish</option>
                            <option value="0">Save in draft</option>
                        </select>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success" style="margin-bottom: 0px;">Upload</button>
                    </div>
                </form>
                <div class="ln_solid"></div>

                @if(empty($images->count()))
                    <p>No record found.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Date/Time Added</th>
                                <th>Operations</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($images as $image)
                                <tr>
                                    <td>{{ (($images->currentPage() - 1 ) * $images->perPage() ) + $loop->iteration }}</td>
                                    <td><img class="img-responsive thumbnail_img" src="{{  asset($image->thumbnail) }}" /></td>
                                    <td>
                                        @if($image->status == 1)
                                            <span class="enable">Active</span>
                                        @else
                                            <span class="disable">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $image->updated_at->format('F d, Y') }}</td>
                                    <td>
                                        <form action="{{ route('gallery.update', $image->id) }}" method="post"
                                              onsubmit="return confirm('Revert process will Enable/Disable the image. Continue?');">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="put" />
                                            <input type="hidden" name="id" value="{{ $image->id }}" />
                                            <button type="submit" class="btn btn-sm btn-info action_btn">Revert</button>
                                        </form>
                                        <form action="{{ route('gallery.destroy', $image->id) }}" method="post"
                                              onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($images->total() != 0)
                            <div>Showing
                                {{ ($images->currentpage()-1) * $images->perpage()+1}} to
                                {{(($images->currentpage()-1) * $images->perpage())+$images->count()}} of
                                {{$images->total()}} records
                            </div>
                            {{ $images->links() }}
                        @else
                            No records found.
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>