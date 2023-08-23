@extends('layouts.front')

@push('onepage_custom_style')
<link rel="stylesheet" href="/frontend/assets/subcategory.css">
<style>
    .header{
        background-image: linear-gradient(to bottom, rgb(0 0 0 / 50%), rgb(117 19 93 / 0%)), url("{{Storage::url($category? $category->category_image : '')}}");
        height: 300px;
        background-repeat: no-repeat;
        background-blend-mode: multiply;
        position: relative;
        background-color: #bfbfbf36 !important;
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    .nav-list > li.active{
        background-color: #ffff0000;
    }

    .nav-list > li.active > a{
        color: yellow !important;
    }


</style>
@endpush

@section('content')
    <section class="products section" id="course">
            <a class="flex category-back-ico" href="/products">
                <span>«</span>
                <span>SUB CATEGORY</span>
            </a>
            <div class="featured-container grid">
                @if (isset($subcategories))
                    @foreach($subcategories as $row)
                    <div class="products-card">
                        <a style="color: inherit;"  class="products-link">
                            <h1 class="products-title">{{ $row->title }}</h1>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="modal-dailog">
                @include("popup")
            </div>
      </section>
@endsection

@push("scripts")
<script>
    $(".close-modal").click(function(){
        $(".modal-dailog").remove();
    })
</script>
@endpush
