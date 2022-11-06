@extends('layouts.dashboard')

@section('content')
    @push('addon-css')
        <style>
            .ck-editor__editable_inline {
                min-height: 200px;
            }
        </style>
    @endpush
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Article</h1>
    </div>

    <div class="col-lg-8" style="margin-bottom: 10rem;">
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-dark ">
                        back
                    </a>
                    <button class="reset btn btn-warning mx-3">
                        Cancel
                    </button>
                </div>
                <button type="submit" class="btn btn-success px-4">
                    Save
                </button>
            </div>
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input class="form form-control @error('title') is-invalid @enderror" type="text" name="title"
                    value="{{ $article->title }}" autofocus>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="author" class="form-label">Author</label>
                <input class="form form-control @error('author') is-invalid @enderror" type="text" name="author"
                    value="{{ $article->author }}">
                @error('author')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option selected value="">Select for category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $category->id) == $article->category_id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                <img class="img-preview img-fluid mb-3 col-sm-5 d-block" style="border-radius: 5px"
                    {{ $article->featured_image != null ? 'src=' . $article->featured_image : '' }}>
                <input type="file" class="form form-control @error('featured_image') is-invalid @enderror"
                    id="featured_image" onchange="previewImage()" name="featured_image">
                @error('featured_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form form-control" name="content" id="editor">
                    {{ old('content', $article->content) }}
                </textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-dark ">
                        back
                    </a>
                    <button class="reset btn btn-warning mx-3">
                        Cancel
                    </button>
                </div>
                <button type="submit" class="btn btn-success px-4">
                    Save
                </button>
            </div>
        </form>
    </div>
    @push('addon-js')
        <script script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });

            function previewImage() {
                const image = document.querySelector('#featured_image');
                const imgPreview = document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }

            // Get all the reset buttons from the dom
            var resetButtons = document.getElementsByClassName('reset');

            // Loop through each reset buttons to bind the click event
            for (var i = 0; i < resetButtons.length; i++) {
                resetButtons[i].addEventListener('click', resetForm);
            }

            /**
             * Function to hard reset the inputs of a form.
             *
             * @param object event The event object.
             * @return void
             */
            function resetForm(event) {
                const imgPreview = document.querySelector('.img-preview');
                const select = document.querySelector('.form-select');

                event.preventDefault();

                var form = event.currentTarget.form;
                var inputs = form.querySelectorAll('.form');

                inputs.forEach(function(input, index) {
                    input.value = null;
                });

                select.value = 'Select for category';
                imgPreview.style.display = 'none';
                document.querySelector(
                    "body > div.container-fluid > div > main > div.col-lg-8 > form > div:nth-child(6) > div > div.ck.ck-editor__main > div"
                ).innerHTML = '';
            }
        </script>
    @endpush
@endsection
