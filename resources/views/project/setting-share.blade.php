@extends('layouts.project-setting')

@section('project-setting')
    <div class="card card-white">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('project:invite', ['project_id' => $project->id]) }}">添加分享邀请</a>
        </div>
    </div>

    @if($pager->total())
    <div class="card card-white mt-3">
        <div class="card-header">分享用户</div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>分享码</th>
                <th>过期时间</th>
                <th>邀请用户</th>
                <th>@lang('common.operation')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pager->items() as $token)
                <tr>
                    <th scope="row">{{ $token->id }}</th>
                    <td>{{ $token->token }}</td>
                    <td>{{ $token->expired_at }}</td>
                    <td>
                        {{ $token->accept_uid ? $token->acceptUser->name : '[未使用]' }}
                    </td>
                    <td>
                        <button class="btn btn-primary get-link-btn" data-url="{{ route('login', ['token'=>$token->token]) }}">获取链接</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="wz-pagination">
            {{ $pager->links() }}
        </div>
    </div>
    @endif

@endsection

@push('script')
<script>
    $(document).ready(()=>{
      $('.get-link-btn').click(function(){
        const url = $(this).data('url');
        $.wz.alert('分享链接为<br/><a href="'+url+'" target="_blank">'+url+'</a>');
      })
    });
</script>
@endpush