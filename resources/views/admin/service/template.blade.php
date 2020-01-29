@if ($services)
    @foreach ($services as $item)
        <section id="tiktok" class="service wow fadeInUp" data-wow-delay="300ms">
            <!-- change the image in style.css to the class .number .container-fluid [approximately row 102] -->
            <div class="container">
                <div class="row">
                    <div class="section-title">
                        <h3 class="section-title-h3">{{ $item->title }}<span style="color: red; font-style: italic;">{{ $item->new ? ' | Новинка!' : '' }}</span></h3>
                        <h4 class="section-title-h4">{{ $item->sub_title }}</h4>
                    </div>
                    <div class="col-md-6 block-thumb">
                        <img src="{{ $item->getFile('thumb') }}">
                    </div>
                    <div class="col-md-6">
                        {!! $item->body !!}
                        <p class="section-price">{{ $item->price }} руб./месяц</p>
                        <a href="#iw-modal" class="btn btn-danger iw-modal-btn">ЗАКАЗАТЬ</a>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endif
