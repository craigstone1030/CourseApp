@extends('layouts.admin')

@push("style-alt")
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endpush

@section('content')

<div class="card">
    <div class="card-header">
        productLearn
    </div>
    <div class="card-body">
        <form id="learnFrm" action="/admin/learn/product/store" method="POST" onsubmit="return checkValidation()" enctype="multipart/form-data">
            @csrf
            <div class="form-group{{ $errors->has('productLearn') ? 'has-error' : '' }}">
                <label for="title">Title*</label>
                <input id="title" name="title" rows="5" class="form-control"  value="{{ old('productLearn', isset($productLearn) ? $productLearn->title : '') }}">

                @if($errors->has('productLearn'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('productLearn') ? 'has-error' : '' }}">
                <label for="content">content*</label>
                <textarea id="content" name="content" class="form-control"  >
                    {{ old('question', isset($productLearn) ? $productLearn->content : '') }}
                </textarea>
                @if($errors->has('content'))
                    <em class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('learn') ? 'has-error' : '' }}">
                <label for="content">Attachments*</label>
                <input type="file" id="files" name="files[]" multiple accept=".pdf"  />
            </div>

            <div class="form-group {{ $errors->has('learn') ? 'has-error' : '' }}" style="display:flex">
                @foreach ($attachments as $row)
                    <div style="margin-right:20px"><a href="{{ Storage::url($row->file_url) }}" target="_blank">{{ $row->filename }}</a></div>
                @endforeach
            </div>

            <div class="form-group row">
                <div class="col-md-4 {{ $errors->has('reserved') ? 'has-error' : '' }}">
                    <label for="resolved_num">Resolved*</label>
                    <input id="resolved_num" name="resolved_num" rows="5" class="form-control"  value="{{ old('productLearn', isset($productLearn) ? $productLearn->resolved_num : '') }}">
                    @if($errors->has('resolved_num'))
                        <em class="invalid-feedback">
                            {{ $errors->first('resolved_num') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-4 {{ $errors->has('received') ? 'has-error' : '' }}">
                    <label for="received_num">Received*</label>
                    <input id="received_num" name="received_num" rows="5" class="form-control"  value="{{ old('productLearn', isset($productLearn) ? $productLearn->received_num : '') }}">
                    @if($errors->has('received_num'))
                        <em class="invalid-feedback">
                            {{ $errors->first('received_num') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-4 {{ $errors->has('response_time') ? 'has-error' : '' }}">
                    <label for="response_time">Average first response time*</label>
                    <input id="response_time" name="response_time" rows="5" class="form-control"  value="{{ old('productLearn', isset($productLearn) ? $productLearn->response_time : '') }}">
                    @if($errors->has('response_time'))
                        <em class="invalid-feedback">
                            {{ $errors->first('response_time') }}
                        </em>
                    @endif
                </div>
            </div>
            <div>
                <button class="btn btn-primary" id="submit" type="submit" >Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push("script-alt")
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .then( editor => {
                window.editor = editor;
            })
            .catch( error => {
                console.error( error );
            });

        /**
         * Check form validation
         * @param null
         * @return boolean
         */
        const checkValidation = () => {

            const title    = $("#title").val();
            const content  = $("div.ck-content").html();
            const resolved = $("#resolved_num").val();
            const received = $("#received_num").val();
            const response_time = $("#response_time").val();
            const isEmptyContent = $(content).find("br").attr('data-cke-filler');

            if(title == "" || title == null) {
                alert("Invalid title!");
                return false;
            } else if( isEmptyContent == 'true') {
                alert("Invalid content!");
                return false;
            } else if(resolved == "" || resolved == null) {
                alert("Invalid resolved!");
                return false;
            } else if(received == "" || received == null) {
                alert("Invalid received!");
                return false;
            } else if(response_time == "" || response_time == null) {
                alert("Invalid response_time!");
                return false;
            } else{
                return true;
            }
        }
    </script>
@endpush
