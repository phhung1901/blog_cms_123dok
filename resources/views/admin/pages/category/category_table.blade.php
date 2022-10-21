@extends("admin.dashboard.index")
@section("admin.content")
    <div class="content-wrapper">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <style>
                                .card-body::after, .card-footer::after, .card-header::after {
                                    display: block;
                                    clear: both;
                                    content: none;
                                }
                            </style>
                            <div
                                style="display: flex; flex-direction: row; justify-content: space-between; align-items: center"
                                class="card-header">
                                <h3 class="card-title"><b>Category</b></h3>
                                <a href="{{route("admin.category.create")}}">
                                    <div class="btn btn-success">Add</div>
                                </a>
                            </div>

                            <div class="card-body">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example2"
                                                   class="table table-bordered table-hover dataTable dtr-inline"
                                                   aria-describedby="example2_info">
                                                <thead>
                                                <tr>
                                                    <th class="sorting" tabindex="0"
                                                        aria-controls="example2" rowspan="1" colspan="1"
                                                        aria-label="Rendering engine: activate to sort column descending"
                                                        aria-sort="ascending">Category name
                                                    </th>
                                                    <th class="sorting" tabindex="0"
                                                        aria-controls="example2" rowspan="1" colspan="1"
                                                        aria-label="Rendering engine: activate to sort column descending"
                                                        aria-sort="ascending">Parent category
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">Slug
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Description
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Engine version: activate to sort column ascending">
                                                        Created at
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Update
                                                        at
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($categories))
                                                    @foreach($categories as $category)
                                                        <tr class="odd">
                                                            <td class="dtr-control sorting_1"
                                                                tabindex="0">{{$category["name"]}}</td>
                                                            <td>
                                                                    <?php
                                                                    if ($category["parent_id"] != null) {
                                                                        $parent = \Illuminate\Support\Facades\DB::table("categories")->find($category["parent_id"]);
                                                                        echo($parent->name);
                                                                    } else {
                                                                        echo "Null";
                                                                    }
                                                                    ?>
                                                            </td>
                                                            <td>{{$category["slug"]}}</td>
                                                            <td>{{$category["description"]}}</td>
                                                            <td>{{$category["created_at"]}}</td>
                                                            <td>{{$category["updated_at"]}}</td>
                                                            <td>
                                                                <a onclick="return confirm('Có thể xóa tất cả các phần tử con ?')"
                                                                   href="{{route("admin.category.destroy", [$category["id"]])}}">
                                                                    <div id="category_destroy" class="btn btn-danger">
                                                                        Delete
                                                                    </div>
                                                                </a>
                                                                <a href="{{route("admin.category.edit", [$category["id"]])}}">
                                                                    <div class="btn btn-primary">Update</div>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                {{--                                                <tfoot>--}}
                                                {{--                                                <tr>--}}
                                                {{--                                                    <th rowspan="1" colspan="1">Category name</th>--}}
                                                {{--                                                    <th rowspan="1" colspan="1">Parent category</th>--}}
                                                {{--                                                    <th rowspan="1" colspan="1">Slug</th>--}}
                                                {{--                                                    <th rowspan="1" colspan="1">Description</th>--}}
                                                {{--                                                    <th rowspan="1" colspan="1">Created at</th>--}}
                                                {{--                                                    <th rowspan="1" colspan="1">Update at</th>--}}
                                                {{--                                                </tr>--}}
                                                {{--                                                </tfoot>--}}
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
