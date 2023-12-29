<div class="col l-2 c-0">
    <div class="slider-bar">
        <h2 class="p-0 leading-6 text-black uppercase m-b-10 m-t-30 fs-16">@lang('lang.filter-prices')</h2>

        <div class="select-price">
            <select name="slct" id="slct" onchange="location = this.value;">
                <option selected disabled>@lang('lang.select-filter-range')</option>
                <option value="?filter_price=0-1000000">@lang('lang.under') 1.000.000 ₫</option>
                <option value="?filter_price=1000000-3000000">@lang('lang.about') 1.000.000 ₫ ~ 3.000.000 ₫</option>
                <option value="?filter_price=3000000-5000000">@lang('lang.about') 3.000.000 ₫ ~ 5.000.000 ₫</option>
                <option value="?filter_price=5000000-7000000">@lang('lang.about') 5.000.000 ₫ ~ 7.000.000 ₫</option>
                <option value="?filter_price=7000000-10000000">@lang('lang.about') 7.000.000 ₫ ~ 10.000.000 ₫</option>
                <option value="?filter_price=10000000-100000000">@lang('lang.over') 10.000.000 ₫</option>
            </select>
        </div>
    </div>

    <div class="category-bar">
        <h2 class="category-bar__title">@lang('lang.category-product')</h2>

        <div class="panel-group category-bar__panel" id="accordian">

            @foreach ($categories as $cate)
                <div class="panel panel-default">
                    @if ($cate->category_parent == 0)
                        <div class="panel-heading m-b-10">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian"
                                    class="category-bar__link"
                                    href="#{{ $cate->category_slug }}">
                                    <span class="caret"></span>
                                    {{ $cate->category_name }}
                                </a>
                            </h4>
                        </div>

                        <div id="{{ $cate->category_slug }}" class="panel-collapse collapse">
                            <div class="panel-body m-b-5 m-l-15">
                                <ul>
                                    @foreach ($categories as $cate_sub)
                                        @if ($cate_sub->category_parent == $cate->category_id)
                                            <li class="p-b-5">
                                                <a class="category-bar-col__link" href="{{ route('product_category_slug', ['category_slug' => $cate_sub->category_slug]) }}">{{ $cate_sub->category_name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

            @endforeach
        </div>
    </div>

    <div class="brand-bar">
        <h2 class="brand-bar__title">@lang('lang.brand')</h2>

        <div class="panel-group brand-bar__panel" id="accordian">
            @foreach ($brands as $brand)
                <div class="panel panel-default">
                    <ul>
                        <li class="p-b-5">
                            <a class="brand-bar__link" href="?brand={{ $brand->brand_slug }}">{{ $brand->brand_name }}</a>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
