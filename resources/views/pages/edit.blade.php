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

         <div ng-controller="PageTagController" page-id="{{ $page->id or 0 }}">
             <h4>{{ trans('entities.page_tags') }}</h4>
             <div class="padded tags">
                 <p class="muted small">{!! nl2br(e(trans('entities.tags_explain'))) !!}</p>
                 <table class="no-style" tag-autosuggestions style="width: 100%;">
                 <tbody ui-sortable="sortOptions" ng-model="tags" >
                    <tr ng-repeat="tag in tags track by $index">
                        <td width="20" ><i class="handle zmdi zmdi-menu"></i></td>
                        <td><input autosuggest="{{ baseUrl('/ajax/tags/suggest/names') }}" autosuggest-type="name" class="outline" ng-attr-name="tags[@{{$index}}][name]" type="text" ng-model="tag.name" ng-change="tagChange(tag)" ng-blur="tagBlur(tag)" placeholder="{{ trans('entities.tag') }}"></td>
                        <td><input autosuggest="{{ baseUrl('/ajax/tags/suggest/values') }}" autosuggest-type="value" class="outline" ng-attr-name="tags[@{{$index}}][value]" type="text" ng-model="tag.value" ng-change="tagChange(tag)" ng-blur="tagBlur(tag)" placeholder="{{ trans('entities.tag_value') }}"></td>
                        <td width="10" ng-show="tags.length != 1" class="text-center text-neg" style="padding: 0;" ng-click="removeTag(tag)"><i class="zmdi zmdi-close"></i></td>
                    </tr>
                </tbody>
                </table>
                <table class="no-style" style="width: 100%;">
                <tbody>
                <tr class="unsortable">
                    <td  width="34"></td>
                    <td ng-click="addEmptyTag()">
                        <button type="button" class="text-button">{{ trans('entities.tags_add') }}</button>
                    </td>
                    <td></td>
                </tr>
                </tbody>
                </table>
            </div>
          
        </div>
        </form>

    </div>
    <script>
    var simplemde = new SimpleMDE({ element: document.getElementById("mde") });
    </script>

@stop
