@extends('layouts.default')
@section('title', $project->name)
@section('container-style', 'container-fluid')
@section('content')

    <div class="row marketing wz-main-container-full">
        <form class="w-100" method="POST" id="wz-doc-edit-form"
              action="{{ $newPage ? wzRoute('project:doc:new:show', ['id' => $project->id]) : wzRoute('project:doc:edit:show', ['id' => $project->id, 'page_id' => $pageItem->id]) }}">

            @include('components.doc-edit', ['project' => $project, 'pageItem' => $pageItem ?? null, 'navigator' => $navigator])
            <div class="row">
                <input type="hidden" name="type" value="vditor"/>
                <div class="col" style="padding-left: 0; padding-right: 0;">
                    <div id="vditor"></div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('stylesheet')
    <link href="{{ cdn_resource('/assets/vendor/editor-md/css/editormd.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vditor/dist/index.css" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vditor/dist/index.min.js"></script>


    <script type="text/html" id="editor-template-dialog">
        <form>
            <div class="wz-template-dialog">
                @foreach(wzTemplates() as $temp)
                    <div>
                        <label title="{{ $temp['description'] }}">
                            <input type="radio" name="template" value="{{ $temp['id'] }}"
                                   data-content="{{ base64_encode($temp['content']) }}" {{ $temp['default'] ? 'checked' : '' }}>
                            {{ $temp['name'] }}
                            @if($temp['scope'] == \App\Models\Template::SCOPE_PRIVATE)
                                【@lang('project.privilege_private')】
                            @endif
                        </label>
                    </div>
                @endforeach
            </div>
        </form>
    </script>

    <script>
      let toolbar
      if (window.innerWidth < 768) {
        toolbar = [
          'emoji',
          'headings',
          'bold',
          'italic',
          'strike',
          'link',
          '|',
          'list',
          'ordered-list',
          'check',
          'outdent',
          'indent',
          '|',
          'quote',
          'line',
          'code',
          'inline-code',
          'insert-before',
          'insert-after',
          '|',
          'upload',
          'record',
          'table',
          '|',
          'undo',
          'redo',
          '|',
          'edit-mode',
          'content-theme',
          'code-theme',
          'export',
          {
            name: 'more',
            toolbar: [
              'fullscreen',
              'both',
              'format',
              'preview',
              'info',
              'help',
            ],
          }]
      }

      window.vditor = new Vditor('vditor', {
        cache: {
          enable: false,
        },
        toolbar,
        height: window.innerHeight + 100,
        outline: true,
        debugger: false,
        typewriterMode: false,
        placeholder: 'Hello World!',
        preview: {
          markdown: {
            toc: true,
          },
        },
        toolbarConfig: {
          pin: true,
        },
        counter: {
          enable: true,
          type: 'text',
        },
        hint: {
          emojiPath: 'https://cdn.jsdelivr.net/npm/vditor@1.8.3/dist/images/emoji',
          emojiTail: '<a href="https://hacpai.com/settings/function" target="_blank">设置常用表情</a>',
          emoji: {
            'sd': '💔',
            'j': 'https://unpkg.com/vditor@1.3.1/dist/images/emoji/j.png',
          },
        },
        tab: '\t',
        upload: {
          accept: 'image/*,.mp3',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          // token: 'test',
          url: "/upload",
          linkToImgUrl: '/fetch',
          format(files, responseText) {
            const response = JSON.parse(responseText)
            const succMap = {}
            response.url.map(item => {
              succMap[item.name] = item.url
            })
            return JSON.stringify({
              "msg": "",
              "code": 0,
              "data": {
                "errFiles": [],
                "succMap": succMap
              }
            })
          },
          filename (name) {
            return name.replace(/[^(a-zA-Z0-9\u4e00-\u9fa5\.)]/g, '').
            replace(/[\?\\/:|<>\*\[\]\(\)\$%\{\}@~]/g, '').
            replace('/\\s/g', '')
          },
        },
        value: <?php echo json_encode($pageItem->content ?? '')?>
      });

      $.global.markdownEditor = vditor;

      $.global.getEditorContent = function () {
        try {
          return vditor.getValue();
        } catch (e) {
        }

        return '';
      };

      $.global.getDraftKey = function () {
        return 'markdown-editor-content-{{ $project->id ?? '' }}-{{ $pageItem->id ?? '' }}';
      };

      $.global.updateEditorContent = function (content) {
        vditor.setValue(content)
      };

    </script>
@endpush

@section('bootstrap-material-init')
    <!-- 没办法，material-design与editor-md的js冲突，导致editor-md无法自动滚动 -->
@endsection