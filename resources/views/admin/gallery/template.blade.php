@if ($gallery)
    <section id="photos" class="whiteback wow fadeInUp" data-wow-delay="300ms">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h3 class="section-title-h3">Сертификаты</h3>
                </div>
                <div class="masonry image-gallery">
                    <div class="grid-sizer"></div>
                    <div class="gutter-sizer"></div>
                    @foreach($gallery as $item)
                        <div class="item">
                            <a href="{{ $item->getThumb() }}">
                                <img src="{{ $item->getThumb('thumb') }}" alt="{{ $item->title }}" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
