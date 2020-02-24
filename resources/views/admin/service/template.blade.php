@if ($services)
    @foreach ($services as $item)
        <section id="item-{{ $item->id }}" class="service wow fadeInUp" data-wow-delay="300ms">
            <!-- change the image in style.css to the class .number .container-fluid [approximately row 102] -->
            <div class="container">
                <div class="row">
                    <div class="section-title">
                        <h3 class="section-title-h3">
                            {{ $item->title }}
                            {!! $item->new ? '<span class="badge badge-pill badge-new">Новинка</span>' : '' !!}
                            {!! $item->hit ? '<span class="badge badge-pill badge-hit">Хит!</span>' : '' !!}
                            {!! $item->sale ? '<span class="badge badge-pill badge-sale">Скидка</span>' : '' !!}
                        </h3>
                        <h4 class="section-title-h4">{{ $item->sub_title }}</h4>
                    </div>
                    <div class="col-md-6 block-thumb">
                        <img src="{{ $item->getThumb('thumb') }}">
                    </div>
                    <div class="col-md-6">
                        {!! $item->body !!}
                        @if (!empty($item->price))
                            <p class="section-price">{{ $item->price }} руб./месяц</p>
                        @endif
                        <a href="#iw-modal" class="btn btn-danger iw-modal-btn">ЗАКАЗАТЬ</a>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endif
