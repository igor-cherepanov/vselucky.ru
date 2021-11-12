@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 pb-3">
                <h1 style="font-weight: 900;">{{$category->getName()}}</h1>
            </div>
            <div class="col-md-12">
                <div class="row justify-content-center">
                    @forelse ($categories as $key=>$category)
                        <?php /** @var \App\Models\Category $category */ ?>
                        <div class="col-6 {{!($key & 1) ? 'pr-0':'pl-0'}}">
                            <div class="card" style="border-radius: 0; height: 100%">
                                <div class="card-body row">
                                    <div class="col-4">
                                        <img class="card-img-top" src="{{$category->getImgUrl()}}" alt="Card image cap">
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title" style="font-weight: 600;">{{$category->getName()}}</h5>
                                        <p class="card-text">
                                            @forelse($category->getChildren() as $keyChild=>$children)
                                                @if($keyChild < 8)
                                                    <a href="" style="color: #da5abb">{{$children->getName()}}</a>
                                                    @if($keyChild < 7)
                                                        ,
                                                    @endif
                                                @endif
                                            @empty
                                            @endforelse
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
