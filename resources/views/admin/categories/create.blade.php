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
        Create Categories
    </div>

    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFrm()">
            @csrf
            <div class="form-group">
                <label for="title">Parent Category</label>
                <div class="mb-3">
                    <select class="form-control" name="parent_id" id="parent_id">
                        <option value="0">...</option>
                        @if (isset($categories))
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{ $category->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">title*</label>
                <input type="text" id="title" name="title" class="form-control" value="" >
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                <label for="description">Desccription*</label>
                <textarea id="description" name="description" rows="5" class="form-control" value="{{ old('description', isset($category) ? $category->description : '') }}" >
                </textarea>
                @if($errors->has('slug'))
                    <em class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                <label for="category_image">Category Image*</label>
                <input type="file" id="category_image" name="category_image" class="form-control" value="{{ old('category_image', isset($category) ? $category->category_image : '') }}"  />
                @if($errors->has('slug'))
                    <em class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                <label for="published">Published*</label>
                <select name="published" class="form-control" id="published">
                    <option value="1">Active</option>
                    <option value="0">In Active</option>
                </select>
                @if($errors->has('slug'))
                    <em class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </em>
                @endif
            </div>
            <div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-warning" >Back</a>
                <button class="btn btn-danger" type="submit" >Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push("script-alt")
    <script>

        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .then( editor => {
                window.editor = editor;
            })
            .catch( error => {
                console.error( error );
            });

        function validateFrm(){
            const title = $("#title").val();
            const content  = $("div.ck-content").html();
            const isEmptyContent = $(content).find("br").attr('data-cke-filler');
            const category_image = document.getElementById("category_image").files.length;

            if(title == ""){
                toastr.warning("Title is required field!", "Warnning");
                return false;
            } else if( isEmptyContent == "true"){
                toastr.warning("Description is required field!", "Warnning");
                return false;
            } else if(category_image == 0){
                toastr.warning("Image is required field!", "Warnning");
                return false;
            }

            return true;
        }

    </script>
@endpush
