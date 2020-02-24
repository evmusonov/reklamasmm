@if ($reviews)
    <section id="comment-group" class="commentback wow fadeInUp" data-wow-delay="300ms">
        <!-- change the image in style.css to the class .number .container-fluid [approximately row 102] -->
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h3 class="section-title-h3">Отзывы по продвижению</h3>
                </div>
                @foreach($reviews as $item)
                    <div class="col-md-4">
                        <div class="avatar">
                            <img src="{{ $item->getThumb('thumb') }}">
                        </div>
                        <div class="comment">
                            {!! $item->body !!}
                        </div>
                        <div class="name-and-date">
                            <div class="comment-name">
                                {{ $item->author }}
                            </div>
                            <div class="comment-date">
                                {{ $item->created_at }}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="clearfix"></div>
                <div class="more-comment">Больше отзывов о продвижении Вы сможете найти в нашей группе Вконтакте</div>
                <div class="comment-link"><a href="https://vk.com/effectiv_group">vk.com/effectiv_group</a></div>
            </div>
        </div>
    </section>
@endif
