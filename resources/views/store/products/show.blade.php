<x-store-layout>
    <main class="ps-main">
        <div class="test">
            <div class="container">
                <div class="row">
                    <x-flash_message/>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-product--detail pt-60">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-10 col-md-12 col-lg-offset-1">
                        <div class="ps-product__thumbnail">
                            <div class="ps-product__preview">
                                <div class="ps-product__variants">
                                    <div class="item"><img src="{{ $product->image_url }}" alt=""></div>
                                    <div class="item"><img
                                            src="{{ asset('assest/store/images/shoe-detail/2.jpg') }}" alt=""></div>
                                    <div class="item"><img
                                            src="{{ asset('assest/store/images/shoe-detail/3.jpg') }}" alt=""></div>
                                    <div class="item"><img
                                            src="{{ asset('assest/store/images/shoe-detail/3.jpg') }}" alt=""></div>
                                    <div class="item"><img
                                            src="{{ asset('assest/store/images/shoe-detail/3.jpg') }}" alt=""></div>
                                </div><a class="popup-youtube ps-product__video"
                                    href="http://www.youtube.com/watch?v=0O2aH4XLbto"><img
                                        src="{{ $product->image_url }}" alt=""><i class="fa fa-play"></i></a>
                            </div>
                            <div class="ps-product__image">
                                <div class="item"><img class="zoom"
                                        src="{{ $product->image_url }}" alt=""
                                        data-zoom-image="{{ $product->image_url }}"></div>
                                <div class="item"><img class="zoom"
                                        src="{{ asset('assest/store/images/shoe-detail/2.jpg') }}" alt=""
                                        data-zoom-image="images/shoe-detail/2.jpg')}}"></div>
                                <div class="item"><img class="zoom"
                                        src="{{ asset('assest/store/images/shoe-detail/3.jpg') }}" alt=""
                                        data-zoom-image="images/shoe-detail/3.jpg')}}"></div>
                            </div>
                        </div>
                        <div class="ps-product__thumbnail--mobile">
                            <div class="ps-product__main-img"><img src="{{ $product->image_url }}" alt=""></div>
                            <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true"
                                data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false"
                                data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3"
                                data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img
                                    src="{{ $product->image_url }}" alt=""><img
                                    src="{{ asset('assest/store/images/shoe-detail/2.jpg') }}" alt=""><img
                                    src="{{ asset('assest/store/images/shoe-detail/3.jpg') }}" alt=""></div>
                        </div>
                        <div class="ps-product__info">
                            <div class="ps-product__rating">
                                <select class="ps-rating">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                </select><a href="#">(Read all 8 reviews)</a>
                            </div>
                            <h1>{{ $product->name }}</h1>
                            <p class="ps-product__category"><a
                                    href="{{ route('products', $category) }}">{{ $product->category->name }}</a>
                            </p>
                            <h3 class="ps-product__price">
                                {{ Money::format($product->price) }}<del>{{ Money::format($product->compare_price) }}</del>
                            </h3>
                            <div class="ps-product__block ps-product__quickview">
                                <h4>QUICK REVIEW</h4>
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="ps-product__block ps-product__style">
                                <h4>CHOOSE YOUR STYLE</h4>
                                <ul>
                                    <li><a href="product-detail.html"><img
                                                src="{{ asset('assest/store/images/shoe/sidebar/1.jpg') }}"
                                                alt=""></a>
                                    </li>
                                    <li><a href="product-detail.html"><img
                                                src="{{ asset('assest/store/images/shoe/sidebar/2.jpg') }}"
                                                alt=""></a>
                                    </li>
                                    <li><a href="product-detail.html"><img
                                                src="{{ asset('assest/store/images/shoe/sidebar/3.jpg') }}"
                                                alt=""></a>
                                    </li>
                                    <li><a href="product-detail.html"><img
                                                src="{{ asset('assest/store/images/shoe/sidebar/2.jpg') }}"
                                                alt=""></a>
                                    </li>
                                </ul>
                            </div>
                            <form method='post' action="{{route('cart.store')}}">
                                @csrf
                                <input tpye="text" hidden value="{{$product->id}}" name="product_id">
                                <div class="ps-product__block ps-product__size">
                                    <h4>CHOOSE SIZE<a href="#">Size chart</a></h4>
                                    <select class="ps-select selectpicker">
                                        <option value="1">Select Size</option>
                                        <option value="2">4</option>
                                        <option value="3">4.5</option>
                                        <option value="3">5</option>
                                        <option value="3">6</option>
                                        <option value="3">6.5</option>
                                        <option value="3">7</option>
                                        <option value="3">7.5</option>
                                        <option value="3">8</option>
                                        <option value="3">8.5</option>
                                        <option value="3">9</option>
                                        <option value="3">9.5</option>
                                        <option value="3">10</option>
                                    </select>
                                    <div class="form-group">
                                        <input class="form-control" name="quantity" type="number" value="1">
                                    </div>
                                </div>
                                <div class="ps-product__shopping">
                                    <button class="ps-btn mb-10" type="submit">
                                        Add to cart<i class="ps-icon-next"></i>
                                    </button>
                                    <div class="ps-product__actions"><a class="mr-10" href="whishlist.html"><i
                                                class="ps-icon-heart"></i></a><a href="compare.html"><i
                                                class="ps-icon-share"></i></a></div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <div class="ps-product__content mt-50">
                            <ul class="tab-list" role="tablist">
                                <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab"
                                        data-toggle="tab">Overview</a></li>
                                <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a>
                                </li>
                                <li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">PRODUCT
                                        TAG</a></li>
                                <li><a href="#tab_04" aria-controls="tab_04" role="tab" data-toggle="tab">ADDITIONAL</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content mb-60">
                            <div class="tab-pane active" role="tabpanel" id="tab_01">
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab_02">
                                <p class="mb-20">1 review for <strong>Shoes Air Jordan</strong></p>
                                <div class="ps-review">
                                    <div class="ps-review__thumbnail"><img
                                            src="{{ asset('assest/store/images/user/1.jpg') }}" alt=""></div>
                                    <div class="ps-review__content">
                                        <header>
                                            <select class="ps-rating">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <p>By<a href=""> Alena Studio</a> - November 25, 2017</p>
                                        </header>
                                        <p>Soufflé danish gummi bears tart. Pie wafer icing. Gummies jelly beans powder.
                                            Chocolate bar pudding macaroon candy canes chocolate apple pie chocolate
                                            cake. Sweet caramels sesame snaps halvah bear claw wafer. Sweet roll soufflé
                                            muffin topping muffin brownie. Tart bear claw cake tiramisu chocolate bar
                                            gummies dragée lemon drops brownie.</p>
                                    </div>
                                </div>
                                <form class="ps-product__review" action="_action" method="post">
                                    <h4>ADD YOUR REVIEW</h4>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group">
                                                <label>Name:<span>*</span></label>
                                                <input class="form-control" type="text" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Email:<span>*</span></label>
                                                <input class="form-control" type="email" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Your rating<span></span></label>
                                                <select class="ps-rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                                            <div class="form-group">
                                                <label>Your Review:</label>
                                                <textarea class="form-control" rows="6"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class="ps-btn ps-btn--sm">Submit<i
                                                        class="ps-icon-next"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab_03">
                                <p>Add your tag <span> *</span></p>
                                <form class="ps-product__tags" action="_action" method="post">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="">
                                        <button class="ps-btn ps-btn--sm">Add Tags</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab_04">
                                <div class="form-group">
                                    <textarea class="form-control" rows="6"
                                        placeholder="Enter your addition here..."></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="ps-btn" type="button">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
            <div class="ps-container">
                <div class="ps-section__header mb-50">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                            <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <div class="ps-owl-actions"><a class="ps-prev" href="#"><i
                                        class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next"
                                    href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="ps-section__content">
                    <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true"
                        data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false"
                        data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3"
                        data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite"
                                        href="#"><i class="ps-icon-heart"></i></a><img
                                        src="{{ asset('assest/store/images/shoe/1.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('assest/store/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name"
                                            href="product-detai.html">Air Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div>
                                    <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-35%</span></div><a
                                        class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a><img
                                        src="{{ asset('assest/store/images/shoe/2.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('assest/store/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name"
                                            href="product-detai.html">Air Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price">
                                            <del>£220</del> £ 120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite"
                                        href="#"><i class="ps-icon-heart"></i></a><img
                                        src="{{ asset('assest/store/images/shoe/3.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('assest/store/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name"
                                            href="product-detai.html">Air Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                            class="ps-icon-heart"></i></a><img
                                        src="{{ asset('assest/store/images/shoe/4.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('assest/store/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name"
                                            href="product-detai.html">Air Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite"
                                        href="#"><i class="ps-icon-heart"></i></a><img
                                        src="{{ asset('assest/store/images/shoe/5.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('assest/store/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name"
                                            href="product-detai.html">Air Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                            class="ps-icon-heart"></i></a><img
                                        src="{{ asset('assest/store/images/shoe/6.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('assest/store/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('assest/store/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name"
                                            href="product-detai.html">Air Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-subscribe">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ">
                        <h3><i class="fa fa-envelope"></i>Sign up to Newsletter</h3>
                    </div>
                    <div class="col-lg-5 col-md-7 col-sm-12 col-xs-12 ">
                        <form class="ps-subscribe__form" action="do_action" method="post">
                            <input class="form-control" type="text" placeholder="">
                            <button>Sign up now</button>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                        <p>...and receive <span>$20</span> coupon for first shopping.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-footer bg--cover" data-background="images/background/parallax.jpg')}}">
            <div class="ps-footer__content">
                <div class="ps-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--info">
                                <header><a class="ps-logo" href="index.html"><img src="{{asset('assest/store/images/logo-white.png"
                                            alt=""></a>
                                    <h3 class="ps-widget__title">Address Office 1</h3>
                                </header>
                                <footer>
                                    <p><strong>460 West 34th Street, 15th floor, New York</strong></p>
                                    <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                                    <p>Phone: +323 32434 5334</p>
                                    <p>Fax: ++323 32434 5333</p>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--info second">
                                <header>
                                    <h3 class="ps-widget__title">Address Office 2</h3>
                                </header>
                                <footer>
                                    <p><strong>PO Box 16122 Collins Victoria 3000 Australia</strong></p>
                                    <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                                    <p>Phone: +323 32434 5334</p>
                                    <p>Fax: ++323 32434 5333</p>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">Find Our store</h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--link">
                                        <li><a href="#">Coupon Code</a></li>
                                        <li><a href="#">SignUp For Email</a></li>
                                        <li><a href="#">Site Feedback</a></li>
                                        <li><a href="#">Careers</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">Get Help</h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--line">
                                        <li><a href="#">Order Status</a></li>
                                        <li><a href="#">Shipping and Delivery</a></li>
                                        <li><a href="#">Returns</a></li>
                                        <li><a href="#">Payment Options</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">Products</h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--line">
                                        <li><a href="#">Shoes</a></li>
                                        <li><a href="#">Clothing</a></li>
                                        <li><a href="#">Accessries</a></li>
                                        <li><a href="#">Football Boots</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-footer__copyright">
                <div class="ps-container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <p>&copy; <a href="#">SKYTHEMES</a>, Inc. All rights Resevered. Design by <a href="#"> Alena
                                    Studio</a></p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <ul class="ps-social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-store-layout>
