@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 pb-3">
                <h1 style="font-weight: 900;">{{isset($category) ? $category->getname() : 'Каталог'}}</h1>
            </div>
            <div class="col-md-12">
                <div class="row justify-content-center">
                    @forelse ($products as $key=>$product)
                        <?php /** @var \App\Models\product $product */ ?>
                        <div class="col-6 {{!($key & 1) ? 'pr-0':'pl-0'}}">
                            <div class="card" style="border-radius: 0; height: 100%">
                                <div class="card-body row">
                                    <div class="col-4">
                                        <img class="card-img-top" src="{{$product->getImgUrl()}}" alt="Card image cap">
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title" style="font-weight: 600;">
                                            <a href="{{route('products.show',$category, $product)}}"
                                               style="color: black">
                                                {{$product->getName()}}
                                            </a>
                                        </h5>
                                        <p class="card-text">
                                            {{$product->getPrice()}} руб.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection
