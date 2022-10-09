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
                                <h3 class="card-title"><b>Role</b></h3>
                                <a href="">
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
                                                        aria-sort="ascending">Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">Email
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Created_at
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Engine version: activate to sort column ascending">
                                                        Updated_at
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Role
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="0"
                                                        aria-label="CSS grade: activate to sort column ascending">Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($users))
                                                    @foreach($users as $user)
                                                        <tr class="odd">
                                                            <td class="dtr-control sorting_1"
                                                                tabindex="0">{{$user["name"]}}</td>
                                                            <td>{{$user["email"]}}</td>
                                                            <td>{{$user["created_at"]}}</td>
                                                            <td>{{$user["updated_at"]}}</td>
                                                            <td></td>
                                                            <td>
                                                                <a onclick="return confirm('Bạn có muốn xóa ?')"
                                                                   href="">
                                                                    <div id="category_destroy" class="btn btn-danger">
                                                                        Delete
                                                                    </div>
                                                                </a>
                                                                <a href="">
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
    </div>
@endsection
