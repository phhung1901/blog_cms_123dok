@extends("client.dashboard.index")
@section("content")
    <div class="container">
        <div class="blog_banner">
            <div class="img_banner">
                <img src="/asset/images/banner.jpg" alt="banner">
            </div>
            <div class="content_banner">
                <div class="banner_text">
                    <img id="home_review" src="/asset/images/Reviewnha.png" alt="">
                    <img id="finding_text" src="/asset/images/Finding your best home.png" alt="">
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
            <div class="page_title">
                <img src="/asset/images/icon_page.png" alt="">
                <div class="title_page_only">
                    <p>Tin tức</p>
                </div>
            </div>
            <div class="body_post">
                <div class="slection_post">
                    <div class="img_post">
                        <a href="./detail.html"><img id="img_post" src="/asset/images/post1.png" alt=""></a>
                        <img id="save_post" src="/asset/images/Vector.png" alt="">
                    </div>
                    <div class="post_title">
                        <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can Live Where
                            They Work</p>
                    </div>
                    <div class="post_detail">
                        <span class="categories_post">Xã hội</span>
                        &bull;
                        <span class="user_post">Phạm Huy Hưng</span>
                        &bull;
                        <span class="date_post">24/02/2020</span>
                    </div>
                    <div class="content_post">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit diam at feugiat purus, interdum
                            porta sed. Ac ut hendrerit enim et scelerisque nullam lorem. Libero mi velit id vitae...</p>
                    </div>
                </div>

                <div class="more_post">
                    <div class="more_post_list">
                        <div class="img_post">
                            <a href="./detail.html"><img id="img_post" src="/asset/images/more_post.png" alt=""></a>
                            <img id="save_post" src="/asset/images/Vector.png" alt="">
                        </div>
                        <div class="post_title">
                            <p>Making a Housing Wage: Where Restaurant Workers Can They Work</p>
                        </div>
                        <div class="post_detail">
                            <span class="categories_post">Xã hội</span>
                            &bull;
                            <span class="user_post">Phạm Huy Hưng</span>
                            &bull;
                            <span class="date_post">24/02/2020</span>
                        </div>
                    </div>
                    <div class="more_post_list">
                        <div class="img_post">
                            <a href="./detail.html"><img id="img_post" src="/asset/images/post2.png" alt=""></a>
                            <img id="save_post" src="/asset/images/Vector.png" alt="">
                        </div>
                        <div class="post_title">
                            <p>Making a Housing Wage: Where Restaurant Workers Can They Work</p>
                        </div>
                        <div class="post_detail">
                            <span class="categories_post">Xã hội</span>
                            &bull;
                            <span class="user_post">Phạm Huy Hưng</span>
                            &bull;
                            <span class="date_post">24/02/2020</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="body_video">
                <div class="body_video_title">
                    <div class="title">
                        <p>Video</p>
                    </div>
                    <div class="action_title">
                        <p>Xem tất cả</p>
                        <img src="/asset/images/Stroke 2.png" alt="">
                    </div>
                </div>
                <div class="list_video">
                    <div class="selection_video">
                        <div class="img_video">
                            <img src="/asset/images/Vector.png" alt="">
                            <div class="play_video_btn">
                                <div class="border_btn">

                                </div>
                                <div class="ractangle_btn">

                                </div>
                            </div>
                        </div>
                        <div class="video_gradient">
                            <div class="title_video">
                                <p class="categories_post">Đi dạo cạnh đường cao tốc Pháp Vân Cầu Giẽ ổn không?</p>
                                <span class="view_video">5542 lượt xem</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                        </div>
                    </div>
                    <div class="title_video_respon">
                        <p class="categories_post">Đi dạo cạnh đường cao tốc Pháp Vân Cầu Giẽ ổn không?</p>
                        <span class="view_video">5542 lượt xem</span>
                        &bull;
                        <span class="date_post">24/02/2020</span>
                    </div>
                    <div class="more_video">
                        <div class="more_detail">
                            <div class="img_video">
                                <img src="/asset/images/Vector.png" alt="">
                                <div class="play_video_btn">
                                    <div class="border_btn">

                                    </div>
                                    <div class="ractangle_btn">

                                    </div>
                                </div>
                            </div>
                            <div class="post_title">
                                <p>Making a Housing Wage: Where Restaurant should l...</p>
                            </div>
                            <div class="post_detail">
                                <span class="view_video">5542 lượt xem</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                        </div>
                        <div class="more_detail">
                            <div class="img_video">
                                <img src="/asset/images/Vector.png" alt="">
                                <div class="play_video_btn">
                                    <div class="border_btn">

                                    </div>
                                    <div class="ractangle_btn">

                                    </div>
                                </div>
                            </div>
                            <div class="post_title">
                                <p>Making a Housing Wage: Where Restaurant should l...</p>
                            </div>
                            <div class="post_detail">
                                <span class="view_video">5542 lượt xem</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                        </div>
                        <div class="more_detail">
                            <div class="img_video">
                                <img src="/asset/images/Vector.png" alt="">
                                <div class="play_video_btn">
                                    <div class="border_btn">

                                    </div>
                                    <div class="ractangle_btn">

                                    </div>
                                </div>
                            </div>
                            <div class="post_title">
                                <p>Making a Housing Wage: Where Restaurant should l...</p>
                            </div>
                            <div class="post_detail">
                                <span class="view_video">5542 lượt xem</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                        </div>
                        <div class="more_detail">
                            <div class="img_video">
                                <img src="/asset/images/Vector.png" alt="">
                                <div class="play_video_btn">
                                    <div class="border_btn">

                                    </div>
                                    <div class="ractangle_btn">

                                    </div>
                                </div>
                            </div>
                            <div class="post_title">
                                <p>Making a Housing Wage: Where Restaurant should l...</p>
                            </div>
                            <div class="post_detail">
                                <span class="view_video">5542 lượt xem</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list_blog_body">
                <div class="list_blog_title">
                    <p>Danh sách tin</p>
                </div>
                <div class="list_blog">
                    <div class="title_respon">
                        <div class="post_title">
                            <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can
                                Live Where
                                They Work</p>
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
                            <img id="img_post" src="/asset/images/blog1.png" alt="">
                            <img id="save_post" src="/asset/images/Vector.png" alt="">
                        </div>
                        <div class="detail_blog">
                            <div class="post_title">
                                <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can
                                    Live Where
                                    They Work</p>
                            </div>
                            <div class="post_detail">
                                <span class="categories_post">Xã hội</span>
                                &bull;
                                <span class="user_post">Phạm Huy Hưng</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                            <div class="content_post">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit diam at feugiat purus,
                                    interdum
                                    porta sed. Ac ut hendrerit enim et scelerisque nullam lorem. Libero mi velit id
                                    vitae...</p>
                            </div>
                        </div>
                    </div>
                    <div class="title_respon">
                        <div class="post_title">
                            <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can
                                Live Where
                                They Work</p>
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
                            <img id="img_post" src="/asset/images/blog2.png" alt="">
                            <img id="save_post" src="/asset/images/Vector.png" alt="">
                        </div>
                        <div class="detail_blog">
                            <div class="post_title">
                                <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can
                                    Live Where
                                    They Work</p>
                            </div>
                            <div class="post_detail">
                                <span class="categories_post">Xã hội</span>
                                &bull;
                                <span class="user_post">Phạm Huy Hưng</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                            <div class="content_post">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit diam at feugiat purus,
                                    interdum
                                    porta sed. Ac ut hendrerit enim et scelerisque nullam lorem. Libero mi velit id
                                    vitae...</p>
                            </div>
                        </div>
                    </div>
                    <div class="title_respon">
                        <div class="post_title">
                            <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can
                                Live Where
                                They Work</p>
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
                            <img id="img_post" src="/asset/images/blog3.png" alt="">
                            <img id="save_post" src="/asset/images/Vector.png" alt="">
                        </div>
                        <div class="detail_blog">
                            <div class="post_title">
                                <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can
                                    Live Where
                                    They Work</p>
                            </div>
                            <div class="post_detail">
                                <span class="categories_post">Xã hội</span>
                                &bull;
                                <span class="user_post">Phạm Huy Hưng</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                            <div class="content_post">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit diam at feugiat purus,
                                    interdum
                                    porta sed. Ac ut hendrerit enim et scelerisque nullam lorem. Libero mi velit id
                                    vitae...</p>
                            </div>
                        </div>
                    </div>
                    <div class="title_respon">
                        <div class="post_title">
                            <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can
                                Live Where
                                They Work</p>
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
                            <img id="img_post" src="/asset/images/blog4.png" alt="">
                            <img id="save_post" src="/asset/images/Vector.png" alt="">
                        </div>
                        <div class="detail_blog">
                            <div class="post_title">
                                <p>Making a Housing Wage: Where Teachers, First Responders and Restaurant Workers Can
                                    Live Where
                                    They Work</p>
                            </div>
                            <div class="post_detail">
                                <span class="categories_post">Xã hội</span>
                                &bull;
                                <span class="user_post">Phạm Huy Hưng</span>
                                &bull;
                                <span class="date_post">24/02/2020</span>
                            </div>
                            <div class="content_post">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit diam at feugiat purus,
                                    interdum
                                    porta sed. Ac ut hendrerit enim et scelerisque nullam lorem. Libero mi velit id
                                    vitae...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn_show">
                    <button class="show_more_btn">Xem thêm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
