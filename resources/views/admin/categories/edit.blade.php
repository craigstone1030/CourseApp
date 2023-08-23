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
        Categories
    </div>

    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">title*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($category) ? $category->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                <label for="description">Desccription*</label>
                <textarea id="description" name="description" rows="5" class="form-control" required>
                    {{ old('description', isset($category) ? $category->description : '') }}
                </textarea>
                @if($errors->has('slug'))
                    <em class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                <label for="category_image">Category Image*</label>
                <input type="file" id="category_image" name="category_image" class="form-control" value="{{ old('category_image', isset($category) ? $category->category_image : '') }}" />
                @if($errors->has('slug'))
                    <em class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                <label for="published">Published*</label>
                <select name="published" class="form-control" id="published">
                    <option {{ $category->published == 'Active' ? 'selected' : null }} value="1">Active</option>
                    <option {{ $category->published == 'Inactive' ? 'selected' : null }} value="0">In Active</option>
                </select>
                @if($errors->has('slug'))
                    <em class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </em>
                @endif
            </div>

            <div>
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


    </script>
@endpush
