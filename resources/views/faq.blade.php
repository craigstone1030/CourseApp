@extends('layouts.front')
@push("onepage_custom_style")
    <style>
        .faq-items {
            border-bottom: 1px solid #cbcb61;
            margin-top: 30px;
        }

        .faq-header{
            margin-bottom: 10px;
        }
        .faq-content{
            margin-bottom: 20px;
        }
    </style>
@endpush
@section('content')
    <section class="faqs section" id="course">
            @if ($faqs)
                @foreach ($faqs as $faq)
                    <div class="faq-items">
                        <div class="faq-header">
                            <h2>{{ $loop->iteration." . ".$faq->question }}</h2>
                        </div>
                        <div class="faq-content">
                            {{ $faq->answer }}
                        </div>
                    </div>
                @endforeach
            @endif
      </section>
@endsection
