<x-store-layout>
    <div class="ps-products-wrap">
        @if($category->name)
        <h2>{{$category->name}}</h2>
        @endif
    </div
    </div>
    <main class="ps-main">
        <div class="ps-products-wrap pt-80 pb-80">
            <div class="ps-products" data-mh="product-listing">
                <div class="ps-product-action">
                    <div class="ps-product__filter">
                        <select class="ps-select selectpicker">
                            <option value="1">Shortby</option>
                            <option value="2">Name</option>
                            <option value="3">Price (Low to High)</option>
                            <option value="3">Price (High to Low)</option>
                        </select>
                    </div>
                </div>
                {{$products->links('pagination.store')}}
                <div class="ps-product__columns">
                    @foreach($products as $product)
                    <div class="ps-product__column">
                        <x-productCard :product="$product"/>
                    </div>
                    @endforeach
                </div>
                <div class="ps-product-action">
                    <div class="ps-product__filter">
                        <select class="ps-select selectpicker">
                            <option value="1">Shortby</option>
                            <option value="2">Name</option>
                            <option value="3">Price (Low to High)</option>
                            <option value="3">Price (High to Low)</option>
                        </select>
                    </div>
                    <div class="ps-pagination">
                        <ul class="pagination">
                            <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ps-sidebar" data-mh="product-listing">
                <aside class="ps-widget--sidebar ps-widget--category">
                    <div class="ps-widget__header">
                        <h3>Category</h3>
                    </div>
                    <div class="ps-widget__content">
                        <ul class="ps-list--checked">
                            <li class="current"><a href="product-listing.html">Life(521)</a></li>
                            <li><a href="product-listing.html">Running(76)</a></li>
                            <li><a href="product-listing.html">Baseball(21)</a></li>
                            <li><a href="product-listing.html">Football(105)</a></li>
                            <li><a href="product-listing.html">Soccer(108)</a></li>
                            <li><a href="product-listing.html">Trainning & game(47)</a></li>
                            <li><a href="product-listing.html">More</a></li>
                        </ul>
                    </div>
                </aside>
                <aside class="ps-widget--sidebar ps-widget--filter">
                    <div class="ps-widget__header">
                        <h3>Category</h3>
                    </div>
                    <div class="ps-widget__content">
                        <div class="ac-slider" data-default-min="300" data-default-max="2000" data-max="3450"
                            data-step="50" data-unit="$"></div>
                        <p class="ac-slider__meta">Price:<span class="ac-slider__value ac-slider__min"></span>-<span
                                class="ac-slider__value ac-slider__max"></span></p><a class="ac-slider__filter ps-btn"
                            href="#">Filter</a>
                    </div>
                </aside>
                <aside class="ps-widget--sidebar ps-widget--category">
                    <div class="ps-widget__header">
                        <h3>Sky Brand</h3>
                    </div>
                    <div class="ps-widget__content">
                        <ul class="ps-list--checked">
                            <li class="current"><a href="product-listing.html">Nike(521)</a></li>
                            <li><a href="product-listing.html">Adidas(76)</a></li>
                            <li><a href="product-listing.html">Baseball(69)</a></li>
                            <li><a href="product-listing.html">Gucci(36)</a></li>
                            <li><a href="product-listing.html">Dior(108)</a></li>
                            <li><a href="product-listing.html">B&G(108)</a></li>
                            <li><a href="product-listing.html">Louis Vuiton(47)</a></li>
                        </ul>
                    </div>
                </aside>
                <aside class="ps-widget--sidebar ps-widget--category">
                    <div class="ps-widget__header">
                        <h3>Width</h3>
                    </div>
                    <div class="ps-widget__content">
                        <ul class="ps-list--checked">
                            <li class="current"><a href="product-listing.html">Narrow</a></li>
                            <li><a href="product-listing.html">Regular</a></li>
                            <li><a href="product-listing.html">Wide</a></li>
                            <li><a href="product-listing.html">Extra Wide</a></li>
                        </ul>
                    </div>
                </aside>
                <div class="ps-sticky desktop">
                    <aside class="ps-widget--sidebar">
                        <div class="ps-widget__header">
                            <h3>Size</h3>
                        </div>
                        <div class="ps-widget__content">
                            <table class="table ps-table--size">
                                <tbody>
                                    <tr>
                                        <td class="active">3</td>
                                        <td>5.5</td>
                                        <td>8</td>
                                        <td>10.5</td>
                                        <td>13</td>
                                    </tr>
                                    <tr>
                                        <td>3.5</td>
                                        <td>6</td>
                                        <td>8.5</td>
                                        <td>11</td>
                                        <td>13.5</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>6.5</td>
                                        <td>9</td>
                                        <td>11.5</td>
                                        <td>14</td>
                                    </tr>
                                    <tr>
                                        <td>4.5</td>
                                        <td>7</td>
                                        <td>9.5</td>
                                        <td>12</td>
                                        <td>14.5</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>7.5</td>
                                        <td>10</td>
                                        <td>12.5</td>
                                        <td>15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </aside>
                    <aside class="ps-widget--sidebar">
                        <div class="ps-widget__header">
                            <h3>Color</h3>
                        </div>
                        <div class="ps-widget__content">
                            <ul class="ps-list--color">
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
                <!--aside.ps-widget--sidebar-->
                <!--    .ps-widget__header: h3 Ads Banner-->
                <!--    .ps-widget__content-->
                <!--        a(href='product-listing'): img(src="images/offer/sidebar.jpg" alt="")-->
                <!---->
                <!--aside.ps-widget--sidebar-->
                <!--    .ps-widget__header: h3 Best Seller-->
                <!--    .ps-widget__content-->
                <!--        - for (var i = 0; i < 3; i ++)-->
                <!--            .ps-shoe--sidebar-->
                <!--                .ps-shoe__thumbnail-->
                <!--                    a(href='#')-->
                <!--                    img(src="images/shoe/sidebar/"+(i+1)+".jpg" alt="")-->
                <!--                .ps-shoe__content-->
                <!--                    if i == 1-->
                <!--                        a(href='#').ps-shoe__title Nike Flight Bonafide-->
                <!--                    else if i == 2-->
                <!--                        a(href='#').ps-shoe__title Nike Sock Dart QS-->
                <!--                    else-->
                <!--                        a(href='#').ps-shoe__title Men's Sky-->
                <!--                    p <del> £253.00</del> £152.00-->
                <!--                    a(href='#').ps-btn PURCHASE-->
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
        <div class="ps-footer bg--cover" data-background="images/background/parallax.jpg">
            <div class="ps-footer__content">
                <div class="ps-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--info">
                                <header><a class="ps-logo" href="index.html"><img src="images/logo-white.png"
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
