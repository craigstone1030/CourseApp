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
        Learn
    </div>
    <div class="card-body">
        <form id="learnFrm" action="{{ route('admin.learn.update', $learn->id) }}" method="POST" onsubmit="return checkValidation()" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="page">Category*</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $row)
                        <option value="{{ $row->id }}" <?php echo $learn->category_id == $row->id ? "selected" : "" ?> >{{ $row->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group{{ $errors->has('learn') ? 'has-error' : '' }}">
                <label for="title">Title*</label>
                <input id="title" name="title" rows="5" class="form-control"  value="{{ old('learn', isset($learn) ? $learn->title : '') }}">

                @if($errors->has('learn'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif

            </div>
            <div class="form-group {{ $errors->has('learn') ? 'has-error' : '' }}">
                <label for="content">content*</label>
                <textarea id="content" name="content" class="form-control"  >
                    {{ old('question', isset($learn) ? $learn->content : '') }}
                </textarea>
                @if($errors->has('content'))
                    <em class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('learn') ? 'has-error' : '' }}">
                <label for="content">Attachments*</label>
                <input type="file" id="files" name="files[]" multiple accept=".pdf" />
            </div>
            <div class="form-group {{ $errors->has('learn') ? 'has-error' : '' }}" style="display:flex">
                @foreach ($attachments as $row)
                    <div style="margin-right:20px"><a href="{{ Storage::url($row->file_url) }}" target="_blank">{{ $row->filename }}</a></div>
                @endforeach
            </div>
            <div class="form-group row">
                <div class="col-md-4 {{ $errors->has('reserved') ? 'has-error' : '' }}">
                    <label for="resolved_num">Reserved*</label>
                    <input id="resolved_num" name="resolved_num" rows="5" class="form-control"  value="{{ old('learn', isset($learn) ? $learn->resolved_num : '') }}">
                    @if($errors->has('resolved_num'))
                        <em class="invalid-feedback">
                            {{ $errors->first('resolved_num') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-4 {{ $errors->has('received') ? 'has-error' : '' }}">
                    <label for="received_num">Received*</label>
                    <input id="received_num" name="received_num" rows="5" class="form-control"  value="{{ old('learn', isset($learn) ? $learn->received_num : '') }}">
                    @if($errors->has('received_num'))
                        <em class="invalid-feedback">
                            {{ $errors->first('received_num') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-4 {{ $errors->has('response_time') ? 'has-error' : '' }}">
                    <label for="response_time">Average first response time*</label>
                    <input id="response_time" name="response_time" rows="5" class="form-control"  value="{{ old('learn', isset($learn) ? $learn->response_time : '') }}">
                    @if($errors->has('response_time'))
                        <em class="invalid-feedback">
                            {{ $errors->first('response_time') }}
                        </em>
                    @endif
                </div>

            </div>
            <div>
                <a href="{{ url('/admin/learn') }}" class="btn btn-warning" id="submit" type="submit" >Back</a>
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
         *  Check form validation
         *  @param null
         *  @return boolean
         */

        const checkValidation = () => {

            const title    = $("#title").val();
            const content  = $("div.ck-content").html();
            const resolved = $("#resolved_num").val();
            const received = $("#received_num").val();
            const response_time = $("#response_time").val();
            const attachment = document.getElementById("files").files.length;
            const isEmptyContent = $(content).find("br").attr('data-cke-filler');

            if(title == "" || title == null) {
                toastr.warning("Title is required field!", "Warnning");
                return false;
            } else if( isEmptyContent == 'true') {
                toastr.warning("Content is required field!", "Warnning");
                return false;
            } else if(attachment == 0) {
                toastr.warning("Pdf is required field!", "Warnning");
                return false;
            }else if(resolved == "" || resolved == null) {
               toastr.warning("Resolved is required field!", "Warnning");
                return false;
            } else if(received == "" || received == null) {
                toastr.warning("Received is required field!", "Warnning");
                return false;
            } else if(response_time == "" || response_time == null) {
                toastr.warning("Average first response time is required field!", "Warnning");
                return false;
            } else{
                return true;
            }
        }


    </script>
@endpush
