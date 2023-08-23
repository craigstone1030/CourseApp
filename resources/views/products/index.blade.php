@extends('layouts.front')

@section('content')
    <section class="products section" id="course">
            <div class="featured-container grid">
                @foreach($categories as $row)
                    <div class="products-card" style="background: url({{ Storage::url($row->category_image) }});">
                        <a style="color: inherit;"  class="products-link" href="/products/{{$row->id}}/subcateogry">
                            <h1 class="products-title">{{ $row->title }}</h1>
                        </a>
                    </div>
                @endforeach
            </div>
      </section>
@endsection
