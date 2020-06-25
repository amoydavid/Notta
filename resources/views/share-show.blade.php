@extends("layouts.single")
@section('title', $pageItem->title)
@section('page-content')
<nav class="wz-page-control clearfix">
    <h1 class="wz-page-title">
        {{ $pageItem->title }}
    </h1>
    <hr />
</nav>
<div class="markdown-body @if($type == 'vditor')
        vditor-body
@endif" id="markdown-body">
    @if($type == 'markdown')
        <textarea id="append-test" style="display:none;">{{ $pageItem->content }}</textarea>
    @endif
    @if($type == 'table')
        <textarea id="x-spreadsheet-content" class="d-none">{{ $pageItem->content }}</textarea>
        <div id="x-spreadsheet"></div>
    @endif
    @if($type == 'vditor')
        <div id="vditor-preview"></div>
        <div id="outline"></div>
    @endif
</div>
@if($type == 'vditor')
<textarea id="vditor-content" style="display: none">{{$pageItem->content}}</textarea>
@endif

<div class="text-center wz-panel-limit mt-3">~ END ~</div>
@endsection

@includeIf("components.{$type}-show", ['isRead'=>true])

@push('script-pre')
    <script>
        @if($type == 'table')
        $(function () {
            $('.wz-body').css('max-width', '100%');
            $('.wz-panel-limit').css('max-width', '100%');
        });
        @endif
    </script>
@endpush
