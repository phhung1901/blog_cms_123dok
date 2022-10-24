@extends("admin.dashboard.index")
@section("admin.content")
    <style>
        td:last-child {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="content-wrapper">
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
                            <h3 class="card-title"><b>Posts</b></h3>
                            <a href="{{route("admin.post.create")}}">
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
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    <a href="{{route("admin.post.sort", "title")}}">Title</a>
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    <a href="{{route("admin.post.sort", "slug")}}">Slug</a>
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">
                                                    <a href="{{route("admin.post.sort", "category_id")}}">Category</a>
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">Tag
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="0"
                                                    aria-label="CSS grade: activate to sort column ascending">
                                                    <a href="{{route("admin.post.sort", "author_id")}}">User</a>
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="0"
                                                    aria-label="CSS grade: activate to sort column ascending">
                                                    <a href="{{route("admin.post.sort", "status")}}">Status</a>
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="0"
                                                    aria-label="CSS grade: activate to sort column ascending">
                                                    <a href="{{route("admin.post.sort", "created_at")}}">Created_at</a>
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="0"
                                                    aria-label="CSS grade: activate to sort column ascending">
                                                    <a href="{{route("admin.post.sort", "updated_at")}}">Updated_at</a>
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($posts))
                                                @foreach($posts as $post)
                                                    <tr class="odd">
                                                        <td class="dtr-control sorting_1"
                                                            tabindex="0">{{$post["title"]}}</td>
                                                        <td>{{$post["slug"]}}</td>
                                                        <td>{{\App\Http\Services\Admin\Category\CategoryService::getCategory($post["category_id"])}}</td>
                                                        <td>
                                                            @foreach(\App\Http\Services\Admin\Post\PostService::getPostTags($post["id"]) as $tag)
                                                                {{"#".$tag->name.","}}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @php
                                                                $user =\App\Http\Services\Admin\User\UserService::getUser($post["author_id"])->toArray();
                                                            @endphp
                                                            {{$user["name"]}}
                                                        </td>
                                                        <td>{{\App\Enums\PostStatus::getKey($post["status"])}}</td>
                                                        <td>{{$post["created_at"]}}</td>
                                                        <td>{{$post["updated_at"]}}</td>
                                                        <td>
                                                            <a onclick="return confirm('Bạn có muốn xóa ?')"
                                                               href="{{route("admin.post.destroy", [$post["id"]])}}">
                                                                <div id="category_destroy" class="btn btn-danger">
                                                                    Delete
                                                                </div>
                                                            </a>
                                                            <a href="{{route("admin.post.edit", [$post["id"]])}}">
                                                                <div class="btn btn-primary">Update</div>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
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
@endsection
