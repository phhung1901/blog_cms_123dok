@extends("admin.dashboard.index")
@section("admin.content")
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User update</li>
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
                                <h3 class="card-title">User update</h3>
                            </div>
                            <br>
                            @if (\Session::has('error'))
                                <div class="card-body">
                                    <div class="alert alert-danger">
                                        {!! \Session::get('error') !!}
                                    </div>
                                </div>
                            @endif
                            @if(isset($user))
                                <form action="{{route("admin.user.update", [$user["id"]])}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="user_name">User name</label>
                                            <input name="user_name"
                                                   value="{{$user['name']}}" type="text" class="form-control"
                                                   id="user_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input value="{{$user["email"]}}" name="email" type="email"
                                                   class="form-control" id="slug">
                                        </div>
                                        <div style="display: none" class="change_password">
                                            <div class="form-group">
                                                <label for="password">New password</label>
                                                <input name="password" type="password"
                                                       class="form-control" id="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Retype new password</label>
                                                <input name="password_confirmation" type="password"
                                                       class="form-control" id="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                        <button name="change_password" type="button" class="btn btn-warning">Change password</button>
                                    </div>
                                </form>
                                <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
                                <script>
                                    $(document).ready(function(){
                                        $(".btn-warning").click(function (){
                                            $(".change_password").css("display", "block");
                                        });
                                    })
                                </script>
                            @endif
                        </div>

                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection
