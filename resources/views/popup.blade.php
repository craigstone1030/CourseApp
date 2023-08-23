<div class="popup-help" id="sidebar">
    <div class="help-section">
        <div class="description">
            <h1 class="title row">
            @if($category)
                {{ $category->title }}
            </h1>
                {!! $category->description !!}
            @endif
        </div>
    </div>
</div>
<button class="close-modal">ok</button>
