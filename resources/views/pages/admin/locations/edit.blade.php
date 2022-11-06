@extends('layouts.dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Location</h1>
    </div>

    <div class="col-lg-8">
        <form action="{{ route('locations.update', $location->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between mb-3">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-dark mx-3">
                        back
                    </a>
                    <button class="reset btn btn-warning">
                        Cancel
                    </button>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input class="form form-control @error('title') is-invalid @enderror" type="text" name="title"
                    autofocus value="{{ $location->title }}">
                @error('title')
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
                            {{ old('category_id', $category->id) == $category->id ? 'selected' : '' }}>
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
                <label for="address" class="form-label">Address</label>
                <input class="form form-control @error('address') is-invalid @enderror" type="text" name="address"
                    value="{{ $location->address }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input class="form form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                    value="{{ $location->phone }}">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="link" class="form-label">Link</label>
                <input class="form form-control @error('link') is-invalid @enderror" type="text" name="link"
                    velue="{{ $location->link }}">
                @error('link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-dark mx-3">
                        back
                    </a>
                    <button class="reset btn btn-warning">
                        Cancel
                    </button>
                </div>
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
                const image = document.querySelector('#thumbnail');
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
