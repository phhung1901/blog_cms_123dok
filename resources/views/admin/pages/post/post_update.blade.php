@extends("admin.dashboard.index")
@section("admin.content")
    <style>
        .fillable {
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
                                <h3 class="card-title">Update Post</h3>
                            </div>
                            <br>
                            @if (\Session::has('error'))
                                <div class="card body">
                                    <div class="alert alert-danger">
                                        {!! \Session::get('error') !!}
                                    </div>
                                </div>
                            @endif
                            <form action="{{route('admin.post.update', [$post['id']])}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Post title <span class="fillable">*</span></label>
                                        <input value="{{$post["title"]}}" onkeyup="ChangeToSlug();" name="title"
                                               type="text" class="form-control"
                                               id="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input value="{{$post["slug"]}}" name="slug" type="text"
                                               class="form-control" id="slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input value="{{$post["description"]}}" name="description" type="text"
                                               class="form-control" id="description">
                                    </div>
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input value="{{$post['thumbnail']}}" name="file" type="file"
                                                       class="custom-file-input" id="file">
                                                <label class="custom-file-label" for="file">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Old file</label>
                                        <img style="width: -webkit-fill-available"
                                             src="{{Storage::url($post['thumbnail'])}}" alt="">
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label>Contents</label>
                                        </div>
                                        <textarea name="content" id="editor">{{$post["content"]}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Category <span class="fillable">*</span></label>
                                        <select id="category" name="category" class="form-control">
                                            <option value="0">Null</option>
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <option @if($post["category"] == $category["name"]) selected
                                                            @endif value="{{$category["id"]}}">{{$category["name"]}}</option>
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
                                                    <input @foreach($post_tag as $item)
                                                               @if($item["name"] == $tag->name)
                                                                   {{"checked"}}
                                                               @endif
                                                           @endforeach class="tags" value="{{$tag->id}}"
                                                           id="{{$tag->id}}" name="tag[]" type="checkbox">
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
                                                    <option
                                                        @if(\App\Enums\PostStatus::getKey($post["status"]) == $value) selected
                                                        @endif value="{{$value}}">{{$value}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit
                                    </button>
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

            //L???y text t??? th??? input title
            title = document.getElementById("title").value;

            //?????i ch??? hoa th??nh ch??? th?????ng
            slug = title.toLowerCase();

            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
            slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
            slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
            slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
            slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
            slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
            slug = slug.replace(/??|???|???|???|???/gi, 'y');
            slug = slug.replace(/??/gi, 'd');
            //X??a c??c k?? t??? ?????t bi???t
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
            slug = slug.replace(/ /gi, "-");
            //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
            //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox c?? id ???slug???
            document.getElementById('slug').value = slug;
        }
    </script>
    <script>
        // import EasyImage from '@ckeditor/ckeditor5-easy-image/src/easyimage';
        // import Image from '@ckeditor/ckeditor5-image/src/image';

        ClassicEditor
            .create(document.querySelector('#editor'), {})
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>

        //check form store post

        $(document).ready(function () {
            $("#submit").click(function () {
                var title = $("#title").val();
                var check = $('.icheck-primary').find('input[type=checkbox]:checked').length;
                var category = $("#category").val();

                if (title == "") {
                    alert("Pls fill in title input");
                    $("#title").focus();
                    return false;
                }

                if (category == 0) {
                    alert("Pls select a category");
                    return false;
                }

                if (check == 0) {
                    alert("Pls choice a tag");
                    return false;
                }

                return true;
            })
        });
    </script>
@endsection
