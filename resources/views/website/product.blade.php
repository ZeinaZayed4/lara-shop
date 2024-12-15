@extends('website.layout')

@section('content')
    <!-- details_section - start -->
    <section class="details_section shop_details sec_ptb_140 clearfix">
        <div class="container">
            <div class="row mb_100 justify-content-lg-between justify-content-md-center">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="shop_details_image">
                        <div class="tab-content zoom-gallery">
                            @foreach($product->photos as $photo)
                                <div id="tab_{{ $loop->index }}" class="tab-pane {{ $loop->first ? 'active' : 'fade' }}">
                                    <a class="popup_image zoom-image" data-image="{{ asset($photo->path) }}" href="{{ asset($photo->path) }}">
                                        <img src="{{ asset($photo->path) }}" alt="image_not_found">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <ul class="nav ul_li clearfix" role="tablist">
                            @foreach($product->photos as $photo)
                                <li>
                                    <a class="{{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#tab_{{ $loop->index }}">
                                        <img src="{{ asset($photo->path) }}" alt="image_not_found">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="shop_details_content">
                        <h2 class="item_title">{{ $product->name }}</h2>
                        <span class="item_price">{{ $product->price }}</span>
                        <hr>
                        <p class="mb-0">
                            {{ Str::words($product->description, 25) }}
                        </p>
                        <ul class="btns_group_1 ul_li mb_30 clearfix">
                            <li>
                                <div class="quantity_input">
                                    <form action="#">
                                        <span class="input_number_decrement">–</span>
                                        <input class="input_number" type="text" value="1">
                                        <span class="input_number_increment">+</span>
                                    </form>
                                </div>
                            </li>
                            <li>
                                <a id="cart-btn" class="custom_btn bg_black text-uppercase" href="{{ url('add-to-cart') }}">
                                    <i class="fal fa-shopping-bag mr-2"></i>
                                    Add To Cart
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <ul class="product_info ul_li_block clearfix">
                            <li>
                                <strong>SKU:</strong>{{ $product->SKU }}
                            </li>
                            <li>
                                <strong>Category:</strong>
                                <a href="{{ url('/category/' . $product) }}">
                                    {{ $product->category->name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="details_description_tab mb_100">
                <ul class="nav ul_li text-uppercase" role="tablist">
                    <li>
                        <a class="active" data-toggle="tab" href="#description_tab">Product Description</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#reviews_tab">Reviews</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="description_tab" class="tab-pane active">
                        <div class="row mb_50">
                            {{ $product->description }}
                        </div>
                    </div>

                    <div id="reviews_tab" class="tab-pane fade">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form_item">
                                        <input type="text" name="name" placeholder="Your Name">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form_item">
                                        <input type="email" name="email" placeholder="Your Email">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item">
                                        <input type="text" name="subject" placeholder="Subject">
                                    </div>
                                </div>
                            </div>

                            <div class="form_item">
                                <textarea name="message" placeholder="Your Message"></textarea>
                            </div>
                            <button type="submit" class="custom_btn bg_default_red text-uppercase">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>

            <hr class="mt-0 mb_100">

            @include('website.partials.popular_products')
        </div>
    </section>
    <!-- details_section - end
    ================================================== -->
@endsection
