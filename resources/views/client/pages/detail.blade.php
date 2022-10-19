@extends("client.dashboard.index")
@section("content")
    <div class="container">
        <div class="body">
            <div class="detail_header">
                <div class="back">
                    <a href="./index.html"><img src="/asset/images/Stroke 1.png" alt=""></a>
                    <span id="back">Quay lại</span>
                </div>
                <div class="cate_post">
                    <span id="cate_head">Chuyên mục: </span>
                    <span id="cate_select">{{$post["category"]}}</span>
                </div>
            </div>
            <div class="detail_body">
                <div class="title_detail_post">
                    <p>{{$post["title"]}}</p>
                </div>
                <div class="more_detail_post">
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
                    <div class="action_post">
                        <img src="/asset/images/send_mail.png" alt="">
                        <img src="/asset/images/send_fb.png" alt="">
                        <img src="/asset/images/save.png" alt="">
                    </div>
                    <div class="action_post_respon_1">
                        <img src="/asset/images/Button_1.png" alt="">
                        <img src="/asset/images/Button-1_1.png" alt="">
                        <img src="/asset/images/Button-2_1.png" alt="">
                    </div>
                    <div class="action_post_respon">
                        <img src="/asset/images/Button.png" alt="">
                        <img src="/asset/images/Button-1.png" alt="">
                        <img src="/asset/images/Button-2.png" alt="">
                    </div>
                </div>
                <div class="banner_post">
                    <img src="{{\Illuminate\Support\Facades\Storage::url($post['thumbnail'])}}" alt="">
                </div>
                <div class="content_post">
                    {!! $post["content"] !!}
                </div>
                <div class="tag_detail">
                    @foreach($tags as $tag)
                        <span id="tag_post">#{{$tag["name"]}}</span>
                    @endforeach
                </div>
                <div class="detail_reference">
                    <div class="refer_title">
                        <span id="cate_head">Tin cùng chuyên mục </span>
                        <span id="cate_select">{{$post["category"]}}</span>
                    </div>
                    <div class="show_all">
                        <img src="/asset/images/Stroke 2.png" alt="">
                        <a href="{{route("user.list", [$post['category_slug']])}}"><span>Xem tất cả</span></a>
                    </div>
                </div>
                <div class="list_blog_body">
                    <div class="list_blog">
                        @foreach($posts as $item)
                            <div>
                                <div class="title_respon">
                                    <div class="post_title">
                                        <p>{{$item["title"]}}</p>
                                    </div>
                                    <div class="post_detail">
                                        <span class="categories_post">{{$item["category"]}}</span>
                                        &bull;
                                        <span class="user_post">{{$item["user"]}}</span>
                                        &bull;
                                        <span class="date_post">
                                            @php
                                                $date = $item["created_at"];
                                                $date = date('d-m-Y', strtotime($date));
                                                echo $date;
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                                <div class="blog">
                                    <div class="img_post">
                                        <img id="img_post"
                                             src="{{\Illuminate\Support\Facades\Storage::url($item['thumbnail'])}}"
                                             alt="">
                                    </div>
                                    <div class="detail_blog">
                                        <div class="post_title">
                                            <p>{{$item["title"]}}</p>
                                        </div>
                                        <div class="post_detail">
                                            <span class="categories_post">{{$item["category"]}}</span>
                                            &bull;
                                            <span class="user_post">{{$item["user"]}}</span>
                                            &bull;
                                            <span class="date_post">
                                                @php
                                                    $date = $item["created_at"];
                                                    $date = date('d-m-Y', strtotime($date));
                                                    echo $date;
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="content_post">
                                            <p>{{$item["description"]}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--                <div class="detail_reference">--}}
                {{--                    <div class="refer_title">--}}
                {{--                        <span id="cate_head">Tin thịnh hành </span>--}}
                {{--                        <!-- <span id="cate_select">xã hội</span> -->--}}
                {{--                    </div>--}}
                {{--                    <div class="show_all">--}}
                {{--                        <!-- <img src="/asset/images/Stroke 1.png" alt=""> -->--}}
                {{--                        <span>Xem tất cả</span>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="list_blog_body">--}}
                {{--                    <div class="list_blog">--}}
                {{--                        <div class="title_respon">--}}
                {{--                            <div class="post_title">--}}
                {{--                                <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can--}}
                {{--                                    Live Where--}}
                {{--                                    They Work</p>--}}
                {{--                            </div>--}}
                {{--                            <div class="post_detail">--}}
                {{--                                <span class="categories_post">Xã hội</span>--}}
                {{--                                &bull;--}}
                {{--                                <span class="user_post">Phạm Huy Hưng</span>--}}
                {{--                                &bull;--}}
                {{--                                <span class="date_post">24/02/2020</span>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="blog">--}}
                {{--                            <div class="img_post">--}}
                {{--                                <img id="img_post" src="/asset/images/blog5.png" alt="">--}}
                {{--                            </div>--}}
                {{--                            <div class="detail_blog">--}}
                {{--                                <div class="post_title">--}}
                {{--                                    <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can--}}
                {{--                                        Live Where--}}
                {{--                                        They Work</p>--}}
                {{--                                </div>--}}
                {{--                                <div class="post_detail">--}}
                {{--                                    <span class="categories_post">Xã hội</span>--}}
                {{--                                    &bull;--}}
                {{--                                    <span class="user_post">Phạm Huy Hưng</span>--}}
                {{--                                    &bull;--}}
                {{--                                    <span class="date_post">24/02/2020</span>--}}
                {{--                                </div>--}}
                {{--                                <div class="content_post">--}}
                {{--                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit diam at feugiat purus,--}}
                {{--                                        interdum--}}
                {{--                                        porta sed. Ac ut hendrerit enim et scelerisque nullam lorem. Libero mi velit id--}}
                {{--                                        vitae...</p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="title_respon">--}}
                {{--                            <div class="post_title">--}}
                {{--                                <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can--}}
                {{--                                    Live Where--}}
                {{--                                    They Work</p>--}}
                {{--                            </div>--}}
                {{--                            <div class="post_detail">--}}
                {{--                                <span class="categories_post">Xã hội</span>--}}
                {{--                                &bull;--}}
                {{--                                <span class="user_post">Phạm Huy Hưng</span>--}}
                {{--                                &bull;--}}
                {{--                                <span class="date_post">24/02/2020</span>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="blog">--}}
                {{--                            <div class="img_post">--}}
                {{--                                <img id="img_post" src="/asset/images/blog4.png" alt="">--}}
                {{--                            </div>--}}
                {{--                            <div class="detail_blog">--}}
                {{--                                <div class="post_title">--}}
                {{--                                    <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can--}}
                {{--                                        Live Where--}}
                {{--                                        They Work</p>--}}
                {{--                                </div>--}}
                {{--                                <div class="post_detail">--}}
                {{--                                    <span class="categories_post">Xã hội</span>--}}
                {{--                                    &bull;--}}
                {{--                                    <span class="user_post">Phạm Huy Hưng</span>--}}
                {{--                                    &bull;--}}
                {{--                                    <span class="date_post">24/02/2020</span>--}}
                {{--                                </div>--}}
                {{--                                <div class="content_post">--}}
                {{--                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit diam at feugiat purus,--}}
                {{--                                        interdum--}}
                {{--                                        porta sed. Ac ut hendrerit enim et scelerisque nullam lorem. Libero mi velit id--}}
                {{--                                        vitae...</p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
