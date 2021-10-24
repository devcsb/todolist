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
                <input type="text" class="form-control" name="priority" value="{{ $task->priority }}" readonly="true">

            </div>
        </div>
        <div class="form-group">
            <label>상태</label>
            <div>
                <input type="text" class="form-control" name="status" value="{{ $task->status }}" readonly="true">
            </div>
        </div>
        <div class="form-group">
            <label for="기한">기한</label>

            <input type="text" class="form-control" name="status" value="{{ $task->due_date }}" readonly="true">
        </div>
        <div class="form-group">
            <p>
                            <a href="{{ route('projects.tasks.index', ['project'=> $project->id ]) }}" class="btn btn-info">할일 목록</a>
            </p>


        </div>
@endsection
