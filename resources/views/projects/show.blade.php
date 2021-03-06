@extends('layouts.app')

@section('title')
    프로젝트 정보
@endsection

@section('content')

    <div class="col-md-8">

        <h3>프로젝트 정보</h3>

        <div class="form-group">
            <label for="Project name">프로젝트 명</label>
            <div>
                <input type="text" class="form-control" name="name" value="{{ $project->name }}" readonly="true">
            </div>
        </div>

        <div class="form-group">
            <label for="설명">설명</label>
            <div>
                <textarea class="form-control" rows="3" name="description"
                          readonly="true">{{ $project->description }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="생성일">생성일</label>
            <div>
                <input type="text" class="form-control" name="created_at" value="{{ $project->created_at }}"
                       readonly="true">
            </div>
        </div>
        <div class="form-group">
            <label for="수정일">수정일</label>
            <div>
                <input type="text" class="form-control" name="updated_at" value="{{ $project->updated_at }}"
                       readonly="true">
            </div>
        </div>
        <p>
            <a href="{{ route('projects.tasks.index', ['project'=> $project->id]) }}" class="btn btn-info">Task 목록 보기</a>
        </p>


    </div>
@endsection
