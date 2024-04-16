<x-front-layout title="Home">


    <x-alert type="info"/>
    <section class="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            @foreach($productSlider as $product)
                                <!-- Start Single Slider -->

                                <div class="single-slider"
                                     style="background-image: url('{{ $product->image_url }}');">
                                    <div class="content">
                                        <h2>
                                            {{ $product->name }}
                                        </h2>
                                        <p>{{ $product->description }}</p>
                                        <h3><span>Now Only</span> ${{$product->price}}</h3>
                                        <div class="button">
                                            <a href="{{route('front.products.show',$product,$product->sulg)}}" class="btn">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slider -->
                            @endforeach

                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
            </div>
        </div>
        <section class="trending-product section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Trending Product</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Start Single Product -->

                            <x-product_cart :product="$product"/>

                        </div>
                    @endforeach
                    <!-- End Single Product -->


                </div>
            </div>
        </section>
    </section>

    <!-- Start Featured Categories Area -->
    <section class="featured-categories section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Featured Categories</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categories as $category)

                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Category -->
                        <div class="single-category">
                            <h3 class="heading"> <a href="{{route('front.products.index')}}?filter[category.slug]={{ $category->name }}" >{{ $category->name }}</a></h3>
                            <ul>
                                @foreach ($category['subcategories'] as $subcategory)

                                    <li><a href="{{route('front.products.index')}}?filter[category.slug]={{ $subcategory->name }}" >{{ $subcategory->name }}</a></li>
                                @endforeach
                            </ul>
                            <div class="images">
                                <img src="{{asset('/storage/'.$category->image)}}" width="150px" height="150px" alt="#">
                            </div>
                        </div>
                        <!-- End Single Category -->
                    </div>

                @endforeach

            </div>
        </div>
    </section>
    <!-- End Features Area -->






    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    @push('js')
        <script type="text/javascript">
            //========= Hero Slider
            tns({
                container: '.hero-slider',
                slideBy: 'page',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 0,
                items: 1,
                nav: false,
                controls: true,
                controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
            });

            //======== Brand Slider
            tns({
                container: '.brands-logo-carousel',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 15,
                nav: false,
                controls: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    540: {
                        items: 3,
                    },
                    768: {
                        items: 5,
                    },
                    992: {
                        items: 6,
                    }
                }
            });

        </script>
        <script>
            const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

            const timer = () => {
                const now = new Date().getTime();
                let diff = finaleDate - now;
                if (diff < 0) {
                    document.querySelector('.alert').style.display = 'block';
                    document.querySelector('.container').style.display = 'none';
                }

                let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
                let seconds = Math.floor(diff % (1000 * 60) / 1000);

                days <= 99 ? days = `0${days}` : days;
                days <= 9 ? days = `00${days}` : days;
                hours <= 9 ? hours = `0${hours}` : hours;
                minutes <= 9 ? minutes = `0${minutes}` : minutes;
                seconds <= 9 ? seconds = `0${seconds}` : seconds;

                document.querySelector('#days').textContent = days;
                document.querySelector('#hours').textContent = hours;
                document.querySelector('#minutes').textContent = minutes;
                document.querySelector('#seconds').textContent = seconds;

            }
            timer();
            setInterval(timer, 1000);
        </script>

    @endpush
</x-front-layout>
