@extends("admin.dashboard.index")
@section("admin.content")
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6" style="margin: 0px auto">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add role user</h3>
                            </div>
                            <br>
                            @if (\Session::has('error'))
                                <div class="alert alert-danger">
                                    {!! \Session::get('error') !!}
                                </div>
                            @endif
                            <form action="{{route("admin.user.add_role.sub", [$user["id"]])}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="user_name">User name</label>
                                        <input value="{{$user->name}}" disabled name="user_name" type="text" class="form-control" id="user_name">
                                    </div>
                                </div>
                                @if(isset($roles))
                                    <div class="card-body">
                                        <div class="form-group clearfix">
                                            @foreach($roles as $role)
                                                @if(isset($user_role))
                                                    <div style="margin-right: 20px" class="icheck-primary d-inline">
                                                        <input @if(in_array($role["name"], $user_role)) checked @endif name="roles[]" value="{{$role["id"]}}" type="checkbox" id="{{$role["name"]}}">
                                                        <label for="{{$role["name"]}}">{{$role["name"]}}
                                                        </label>
                                                    </div>
                                                @else
                                                    <div style="margin-right: 20px" class="icheck-primary d-inline">
                                                        <input name="roles[]" value="{{$role["id"]}}" type="checkbox" id="{{$role["name"]}}">
                                                        <label for="{{$role["name"]}}">{{$role["name"]}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="card-footer">
                                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection
