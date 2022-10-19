@extends("client.dashboard.index")
@section("content")
    <div class="container">
        <div class="blog_banner">
            <div class="img_banner">
                <img src="/asset/images/banner.jpg" alt="banner">
            </div>
            <div class="content_banner">
                <div class="banner_text">
                    <img id="home_review" src="/asset/images/Banner.png" alt="">
                </div>
                <div class="banner_step">
                    <button class="btn_step"></button>
                    <button class="btn_step"></button>
                    <button class="btn_step"></button>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="menu_body">
                @if(isset($categories))
                    <a class="btn_menu_body" href="#">Tất cả</a>
                    @foreach($categories as $category)
                        <a class="btn_menu_body"
                           href="{{route("user.list", [$category->slug])}}">{{$category->name}}</a>
                    @endforeach
                @endif
            </div>
            <div class="list_blog_body">
                <div class="list_blog">
                    @if(isset($posts))
                        @foreach($posts as $post)
                            <div>
                                <div class="title_respon">
                                    <div class="post_title">
                                        <p>{{$post["title"]}}</p>
                                    </div>
                                    <div class="post_detail">
                                        <span class="categories_post">Xã hội</span>
                                        &bull;
                                        <span class="user_post">Phạm Huy Hưng</span>
                                        &bull;
                                        <span class="date_post">24/02/2020</span>
                                    </div>
                                </div>
                                <div class="blog">
                                    <div class="img_post">
                                        <a href="{{route("user.detail.post", [$post['slug']])}}"><img id="img_post"
                                                                                                      src="{{\Illuminate\Support\Facades\Storage::url($post["thumbnail"])}}"
                                                                                                      alt=""></a>
                                        <img id="save_post" src="/asset/images/Vector.png" alt="">
                                    </div>
                                    <div class="detail_blog">
                                        <div class="post_title">
                                            <p>{{$post["title"]}}</p>
                                        </div>
                                        <div class="post_detail">
                                            <span class="categories_post">{{$post["category"]}}</span>
                                            &bull;
                                            <span class="user_post">{{$post["user"]}}</span>
                                            &bull;
                                            <span class="date_post">
                                                @php
                                                    $date = $post["created_at"];
                                                    $date = date('d-m-Y', strtotime($date));
                                                    echo $date;
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="content_post">
                                            <p>{{$post["description"]}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="btn_show">
                    <button class="show_more_btn">Xem thêm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
