@push('stylesheet')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vditor/dist/index.css" />
<style>
    #outline {
        display: none;
        position: sticky;
        width: 186px;
        top: 1rem;
        min-height: 200px;
        max-height: calc(100vh - 8rem);
        overflow: auto;
        font-size: 12px;
        border: 1px solid #eee;
        background-color: #fff;
        z-index: 2;
    }

    .vditor-outline__item {
        border-left: 1px solid transparent;
    }

    .vditor-outline__item--current {
        border-left: 1px solid #4285f4;
        color: #4285f4;
        background-color: #f6f8fa;
    }

    .vditor-outline__item:hover {
        color: #4285f4;
        background-color: #f6f8fa;
    }

    #vditor-preview.with-outline {
        margin-right: 1rem;
    }

    .vditor-body {
        display: flex;
    }
    #vditor-preview {
        flex: 1;
    }
</style>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/vditor/dist/index.min.js"></script>

<script src="{{ cdn_resource('/assets/vendor/bootstrap-treeview.js') }}"></script>

<script type="text/javascript">
  const initOutline = () => {
    const headingElements = []
    Array.from(document.getElementById('vditor-preview').children).forEach((item) => {
      if (item.tagName.length === 2 && item.tagName !== 'HR' && item.tagName.indexOf('H') === 0) {
        headingElements.push(item)
      }
    })

    let toc = []
    window.addEventListener('scroll', () => {
      const scrollTop = window.scrollY
      toc = []
      headingElements.forEach((item) => {
        toc.push({
          id: item.id,
          offsetTop: item.offsetTop,
        })
      })

      const currentElement = document.querySelector('.vditor-outline__item--current')
      for (let i = 0, iMax = toc.length; i < iMax; i++) {
        if (scrollTop < toc[i].offsetTop - 30) {
          if (currentElement) {
            currentElement.classList.remove('vditor-outline__item--current')
          }
          let index = i > 0 ? i - 1 : 0
          document.querySelector('div[data-id="' + toc[index].id + '"]').classList.add('vditor-outline__item--current')
          break
        }
      }
    })
  }

    $(function () {

      Vditor.preview(document.getElementById('vditor-preview'),
        $('#vditor-content').text(), {
          speech: {
            enable: true,
          },
          anchor: 1,
          after () {
            if (window.innerWidth <= 768) {
              return
            }
            const outlineElement = document.getElementById('outline')
            if(outlineElement) {
              $('#vditor-preview').addClass('with-outline');

              Vditor.outlineRender(document.getElementById('vditor-preview'), outlineElement)
              if (outlineElement.innerText.trim() !== '') {
                outlineElement.style.display = 'block'
                initOutline()
              }
            }
          },
        })

    });
</script>
@endpush