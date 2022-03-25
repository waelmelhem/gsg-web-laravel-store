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
                src="{{$product->image_url}}" height="200px" width="200px" alt=""><a class="ps-shoe__overlay"
                href="{{route('product.show',[$product->category->slug,$product->slug])}}"></a>
        </div>
        <div class="ps-shoe__content">
            <div class="ps-shoe__variants">
                <div class="ps-shoe__variant normal">
                    @foreach ($product->galleryUrls() as $url)
                    <img src="{{$url}}"alt="" height="70px" width="70px">
                    @endforeach
                    </div>
                <select class="ps-rating ps-shoe__rating">
                    @for($i=1;$i<=5;$i++)
                        <option value="{{$i<= $product->rating?1:$i}}" >{{$i}}</option>
                    @endfor
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