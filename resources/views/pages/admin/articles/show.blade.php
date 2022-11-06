@extends('layouts.dashboard')

@section('content')
    @push('addon-css')
        <style>
            .Article-content-cover {
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                -webkit-text-size-adjust: 100%;
                line-height: 1.42857143;
                -webkit-font-smoothing: antialiased;
                font-family: futurapt !important;
                font-size: 16px;
                color: #484747;
                box-sizing: border-box;
                outline: none !important;
                position: relative;
                padding-top: 75%;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: 50%;
                margin-bottom: 3rem;
                border-radius: 10px;
                /* background-image: url('https://static.fie.org/uploads/28/144749-SQ-FIE-WEB12.jpg'); */
            }
        </style>
    @endpush
    <div class="container">
        <div class="row justify-content-center" style="margin: 64px 0 64px">
            <div class="col-md-8 bg-light border rounded-3 p-5">
                <h1 class="mb-3">{{ $article->title }}</h1>
                <hr>
                <a href="{{ url()->previous() }}" class="btn btn-dark"> <span data-feather="arrow-left"></span> back</a>
                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning my-3"><span
                        data-feather="edit"></span>
                    Edit</a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span
                            data-feather="trash-2"></span> Remove</button>
                </form>

                {{-- <img src="{{ $article->featured_image == null ? 'https://source.unsplash.com/1200x500?' . $article->category->name : asset($article->featured_image) }}"
                    style="max-height: 350px; overflow:hidden" class="card-img-top img-fluid rounded"
                    alt="{{ $article->category->name }}"> --}}
                <div class="Article-content-cover"
                    style="background-image: url('{{ $article->featured_image == null ? 'https://source.unsplash.com/1200x500?' . $article->category->name : $article->featured_image }}')">
                </div>
                {{-- <img src="{{ $article->featured_image == null ? $article->feaetured_image : 'https://source.unsplash.com/1200x500?' . $article->category->name }}"
                    style="max-height: 350px; overflow:hidden" class="card-img-top img-fluid rounded"
                    alt="{{ $article->category->name }}"> --}}
                <article class="my-3 fs-5">
                    {!! $article->content !!}
                </article>
            </div>
        </div>
    </div>
@endsection
