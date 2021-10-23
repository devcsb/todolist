@extends('layouts.app')

@section('title')
    할 일 정보
@endsection

@section('content')

    <div class="col-md-8">

        <h3>할 일 정보</h3>

        <div class="form-group">
            <label for="Project name">할 일 이름</label>
            <div>
                <input type="text" class="form-control" name="name" value="{{ $task->name }}" readonly="true">
            </div>
        </div>

        <div class="form-group">
            <label for="설명">설명</label>
            <div>
                <textarea class="form-control" rows="3" name="description"
                          readonly="true">{{ $task->description }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label>우선순위</label>
            <div>
                <select class="form-control" name="priority">	//2
                    @foreach(['낮음' ,'보통', '높음'] as $p)
                        <option value="{{$p}}" {{ ($task->priority === $p) ? "selected" : "" }}>{{$p}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>상태</label>
            <div>
                <select class="form-control" name="status">	//3
                    @foreach(['등록', '진행', '완료'] as $s)
                        <option value="{{$s}}" {{ ($task->status === $s) ? "selected" : "" }}>{{$s}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="기한">기한</label>
            <div class='input-group date' id='due_date'>
                <input type='text' class="form-control" value=""/>
                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#due_date').datetimepicker({		//4
                        locale: 'en',
                        defaultDate: '{{ \Carbon\Carbon::now() }}',
                        format: 'YYYY-MM-DD HH:mm:ss'
                    });
                });
            </script>
        </div>
        <div class="form-group">
        <p>
{{--            <a href="{{ route('projects.tasks.index', ['project'=> $task->id]) }}" class="btn btn-info">목록 보기</a>--}}
        </p>


    </div>
@endsection
