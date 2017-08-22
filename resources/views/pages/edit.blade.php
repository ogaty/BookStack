@extends('base')

@section('head')
    <script src="{{ baseUrl('/libs/tinymce/tinymce.min.js?ver=4.6.3') }}"></script>
@stop

@section('content')

    @include('components.image-manager', ['imageType' => 'gallery', 'uploaded_to' => $page->id])
    @include('components.code-editor')
    @include('components.entity-selector-popup')

    <div>
         <form action="{{ $page->getUrl() }}" autocomplete="off" method="post" data-page-id="{{ $page->id }}">
            {{ csrf_field() }}
            <div>
                <input type="text" id="name" name="name" placeholder="ページタイトル" value="{{ $page->name }}">
            </div>
            <div>
                <input type="text" id="summary" name="summary" placeholder="概要" value="{{ $page->summary }}">
            </div>
            <textarea id="mde" name="md">{{htmlspecialchars( old('md') ? old('md') : $page->md)}}</textarea>
            <input type="submit" value="保存">
         </form>
    </div>
    <script>
    var simplemde = new SimpleMDE({ element: document.getElementById("mde") });
    </script>

@stop
