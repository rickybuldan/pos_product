@extends('layout.layout_landing_two')
@push('after-style')
    @foreach ($cssFiles as $file)
        <link rel="stylesheet" href="{{ $file }}">
    @endforeach

@endpush

@section('content')
    {{-- <section class="home-slider position-relative pt-50">
        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
            <div class="single-hero-slider single-animation-wrap">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-5 col-md-6">
                            <div class="hero-slider-content-2">
                                <h4 class="animated">Trade-in offer</h4>
                                <h2 class="animated fw-900">Supper value deals</h2>
                                <h1 class="animated fw-900 text-brand">On all products</h1>
                                <p class="animated">Save more with coupons & up to 70% off</p>
                                <a class="animated btn btn-brush btn-brush-3" href="shop-product-right.html">
                                    Shop Now </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="single-slider-img single-slider-img-1">
                                <img class="animated slider-1-1" src="{{ asset('template/frontend/imgs/slider/slider-1.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-slider single-animation-wrap">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-5 col-md-6">
                            <div class="hero-slider-content-2">
                                <h4 class="animated">Hot promotions</h4>
                                <h2 class="animated fw-900">Fashion Trending</h2>
                                <h1 class="animated fw-900 text-7">Great Collection</h1>
                                <p class="animated">Save more with coupons & up to 20% off</p>
                                <a class="animated btn btn-brush btn-brush-2" href="shop-product-right.html">
                                    Discover Now </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="single-slider-img single-slider-img-1">
                                <img class="animated slider-1-2" src="{{ asset('template/frontend/imgs/slider/slider-2.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-slider single-animation-wrap">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-5 col-md-6">
                            <div class="hero-slider-content-2">
                                <h4 class="animated">Upcoming Offer</h4>
                                <h2 class="animated fw-900">Big Deals From</h2>
                                <h1 class="animated fw-900 text-8">Manufacturer</h1>
                                <p class="animated">Clothing, Shoes, Bags, Wallets...</p>
                                <a class="animated btn btn-brush btn-brush-1" href="shop-product-right.html">
                                    Shop Now </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="single-slider-img single-slider-img-1">
                                <img class="animated slider-1-3" src="{{ asset('template/frontend/imgs/slider/slider-3.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-arrow hero-slider-1-arrow"></div>
    </section> --}}
    {{-- <section class="featured section-padding position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('template/frontend/imgs/theme/icons/feature-1.png') }}" alt="">
                        <h4 class="bg-1">Free Shipping</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('template/frontend/imgs/theme/icons/feature-2.png') }}" alt="">
                        <h4 class="bg-3">Online Order</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('template/frontend/imgs/theme/icons/feature-3.png') }}" alt="">
                        <h4 class="bg-2">Save Money</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('template/frontend/imgs/theme/icons/feature-4.png') }}" alt="">
                        <h4 class="bg-4">Promotions</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('template/frontend/imgs/theme/icons/feature-5.png') }}" alt="">
                        <h4 class="bg-5">Happy Sell</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('template/frontend/imgs/theme/icons/feature-6.png') }}" alt="">
                        <h4 class="bg-6">24/7 Support</h4>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="bg-square"></div>
        <div class="container">
            <div class="tab-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" onclick="loadProduct('featured')" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                            type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two"
                            type="button" role="tab" aria-controls="tab-two" aria-selected="false">Popular</button>
                    </li> --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-three" onclick="loadProduct('new')" data-bs-toggle="tab" data-bs-target="#tab-three"
                            type="button" role="tab" aria-controls="tab-three" aria-selected="false">New added</button>
                    </li>
                </ul>
                {{-- <a href="#" class="view-more d-none d-md-flex">Sebelumnya<i
                        class="fi-rs-angle-double-small-right"></i></a>
                 --}}
            </div>
            <!--End nav-tabs-->
            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4 product-featured">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img"
                                                src="{{ asset('template/frontend/imgs/shop/product-1-1.jpg') }}"
                                                alt="">
                                            <img class="hover-img"
                                                src="{{ asset('template/frontend/imgs/shop/product-1-2.jpg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                       
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">Clothing</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">Colorful Pattern Shirts</a></h2>
                                    <div class="rating-result" title="90%">
                                        <span>
                                            <span>90%</span>
                                        </span>
                                    </div>
                                    <div class="product-price">
                                        <span>$238.85 </span>
                                        <span class="old-price">$245.8</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html"><i
                                                class="fi-rs-shopping-bag-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img"
                                                src="{{ asset('template/frontend/imgs/shop/product-2-1.jpg') }}"
                                                alt="">
                                            <img class="hover-img"
                                                src="{{ asset('template/frontend/imgs/shop/product-2-2.jpg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                       
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="new">New</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">Clothing</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">Plain Color Pocket Shirts</a></h2>
                                    <div class="rating-result" title="90%">
                                        <span>
                                            <span>50%</span>
                                        </span>
                                    </div>
                                    <div class="product-price">
                                        <span>$138.85 </span>
                                        <span class="old-price">$255.8</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html"><i
                                                class="fi-rs-shopping-bag-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-center"><a href="#" class="view-more d-none d-md-flex">Lihat Lebih Banyak...</a></div> --}}
                    <!--End product-grid-4-->
                </div>
                <!--En tab one (Featured)-->

                <!--En tab two (Popular)-->
                <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                    <div class="row product-grid-4 product-new-added">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img"
                                                src="{{ asset('template/frontend/imgs/shop/product-2-1.jpg') }}"
                                                alt="">
                                            <img class="hover-img"
                                                src="{{ asset('template/frontend/imgs/shop/product-2-2.jpg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                       
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">Music</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">Donec ut nisl rutrum</a></h2>
                                    <div class="rating-result" title="90%">
                                        <span>
                                            <span>90%</span>
                                        </span>
                                    </div>
                                    <div class="product-price">
                                        <span>$238.85 </span>
                                        <span class="old-price">$245.8</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" onclick="saveCart()"><i
                                                class="fi-rs-shopping-bag-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab three (New added)-->
            </div>
            <!--End tab-content-->
        </div>
    </section>

    <section class="popular-categories section-padding mt-15 mb-25">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20 text-center"><span>Pembelian</span> Online</h3>
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>1. Akun</h6>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <label class="form-label">Nama</label>
                                            <input type="text" placeholder="Nama" id="f-nama" class="form-control">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">No Telp.</label>
                                            <textarea placeholder="No Telp." id="f-telp" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Alamat</label>
                                            <textarea placeholder="Alamat" id="f-alamat" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Catatan</label>
                                            <textarea placeholder="Alamat" id="f-catatan" class="form-control" rows="4"></textarea>
                                        </div>
                                        {{-- <div class="mb-4">
                                            <label class="form-label">Brand name</label>
                                            <select class="form-select">
                                                <option> Adidas </option>
                                                <option> Nike </option>
                                                <option> Puma </option>
                                            </select>
                                        </div> --}}
                                    </div> <!-- col.// -->
                                </div> <!-- row.// -->
                                <hr class="mb-4 mt-0">
                                <!-- row.// -->
                                <hr class="mb-4 mt-0">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>2. Surat Dokter</h6>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <label class="form-label">File PDF</label>
                                            <input class="form-control" type="file" id="f-file-dokter">
                                        </div>
                                    </div> <!-- col.// -->
                                </div> <!-- .row end// -->
                                <div class="row">
                                    <div class="text-dark">
                                        * Informasi harga akan dikirimkan melalui email yang terdaftar.
                                    </div>
                                    <div class="text-dark">
                                        * Diwajibkan mendaftar menggunakan akun email yang aktif.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@push('after-script')
    <script>
        @foreach ($varJs as $varjsi)
            {!! $varjsi !!}
        @endforeach
    </script>


    @foreach ($javascriptFiles as $file)
        <script src="{{ $file }}"></script>
    @endforeach
    <script src="{{ asset('template/admin2/assets/js/owlcarousel/owl.carousel.js') }}"></script>
@endpush
