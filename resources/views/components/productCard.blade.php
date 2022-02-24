@props(['product'])

<div class="grid-item__content-wrapper">
    <div class="ps-shoe mb-30">
        <div class="ps-shoe__thumbnail">
            <div class="ps-badge"><span>New</span>
            </div>
            @if($product->compare_price)
            <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-{{$product->percent}}%</span></div>
            @endif
            <a
                class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a><img
                src="{{$product->image_url}}" alt=""><a class="ps-shoe__overlay"
                href="{{route('product.show',[$product->category->slug,$product->slug])}}"></a>
        </div>
        <div class="ps-shoe__content">
            <div class="ps-shoe__variants">
                <div class="ps-shoe__variant normal"><img src="images/access/1.jpg"
                        alt=""><img src="images/access/2.jpg" alt=""><img
                        src="images/access/3.jpg" alt=""><img src="images/access/4.jpg"
                        alt=""></div>
                <select class="ps-rating ps-shoe__rating">
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="2">5</option>
                </select>
            </div>
            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{route('product.show',[$product->category->slug,$product->slug])}}">{{$product->name}}</a>
                <p class="ps-shoe__categories"><a href="{{route('products',$product->category)}}">{{$product->category->name}}</a></p>
                        <span class="ps-shoe__price">
                    </del> {{Money::format($product->price)}}
                    <br>
                    @if($product->compare_price)
                            <del>{{Money::format($product->compare_price)}}
                            @endif
                </span>
            </div>
        </div>
    </div>
</div>