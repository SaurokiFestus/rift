@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    
</div> -->
<div class="container mt-4">

    <!-- Carousel -->
    <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel" >
        <div class="carousel-inner">
            @php
            $images = [
                    'carousel/image1.jpg',
                    'carousel/image2.jpg',
                    'carousel/image3.jpg'
                ]
            @endphp
            @foreach($images as $index => $image)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 maxheight-50" style="max-height: 400px; object-fit: cover;" alt="Slide {{ $index + 1 }}">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
    
</div>
@endsection