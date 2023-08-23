@if($faqs)
    @foreach ( $faqs as  $faq)
        <div id="faq-{{ $faq->id }}" class="form-group" style="border: 1px solid #d6d6d6;padding: 13px;">
            <div class="header">
                <h2 id="{{ $faq->id }}_question" style="display:inline-block">{{ $faq->question }}</h2>
                <a  id="trash_btn" class="btn" onClick="trashItem({{ $faq->id }})"><i class="fas fa-trash"></i></a>
                <a  id="edit_btn"  class="btn" onClick="editItem({{ $faq->id }})"><i class="fas fa-edit"></i></a>
            </div>
            <div id="{{ $faq->id }}_answer" class="content">
                {{$faq->answer}}
            </div>
        </div>
    @endforeach
@endif
