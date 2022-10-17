@extends("admin.dashboard.index")
@section("admin.content")
    <style>
        .fillable{
            color: red;
        }
    </style>
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Post</li>
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
                                <h3 class="card-title">Create Post</h3>
                            </div>
                            <br>
                            @if (\Session::has('error'))
                                <div class="card body">
                                    <div class="alert alert-danger">
                                        {!! \Session::get('error') !!}
                                    </div>
                                </div>
                            @endif
                            <form action="{{route("admin.post.store")}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Post title <span class="fillable">*</span></label>
                                        <input onkeyup="ChangeToSlug();" name="title" type="text" class="form-control" id="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input name="slug" type="text"
                                               class="form-control" id="slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="file" type="file" class="custom-file-input" id="file">
                                                <label class="custom-file-label" for="file">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label>Contents</label>
                                        </div>
                                        <textarea name="content" id="editor"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Category <span class="fillable">*</span></label>
                                        <select id="category" name="category" class="form-control">
                                            <option value="0">Null</option>
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{$category["id"]}}">{{$category["name"]}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div>
                                            <label>Tags <span class="fillable">*</span></label>
                                        </div>
                                        @if(isset($tags))
                                            @foreach($tags as $tag)
                                                <div style="margin-right: 20px" class="icheck-primary d-inline">
                                                    <input class="tags" value="{{$tag->id}}" id="{{$tag->id}}" name="tag[]" type="checkbox">
                                                    <label for="{{$tag->id}}">
                                                        {{$tag->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            @if(isset($status))
                                                @foreach($status as $value)
                                                    <option value="{{$value}}">{{$value}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script language="javascript">
        function ChangeToSlug() {
            var title, slug;

            //Lấy text từ thẻ input title
            title = document.getElementById("title").value;

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
    </script>
    <script>
        // import EasyImage from '@ckeditor/ckeditor5-easy-image/src/easyimage';
        // import Image from '@ckeditor/ckeditor5-image/src/image';

        ClassicEditor
            .create( document.querySelector( '#editor' ), {

            })
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>

        //check form store post

        $(document).ready(function(){
           $("#submit").click(function (){
               var title = $("#title").val();
               var check = $('.icheck-primary').find('input[type=checkbox]:checked').length;
               var category = $("#category").val();

               if (title == ""){
                   alert("Pls fill in title input");
                   $("#title").focus();
                   return false;
               }

               if (category == 0){
                   alert("Pls select a category");
                   return false;
               }

               if (check == 0){
                   alert("Pls choice a tag");
                   return false;
               }

               return true;
           })
        });
    </script>
@endsection
