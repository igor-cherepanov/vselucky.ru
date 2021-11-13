@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 pb-3">

            </div>
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <img class="card-img-top" src="{{$product->getImgUrl()}}" alt="Card image cap">
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <h1 style="font-weight: 900;">{{$product->getName()}}</h1>
                            </div>
                            <div class="col-12">
                                {{$product->getPrice()}}руб.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
