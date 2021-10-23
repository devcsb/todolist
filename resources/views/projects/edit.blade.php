@extends('layouts.app')

@section('title')
    프로젝트 수정
@endsection

@section('content')

    <div class="col-md-8">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('projects.update', $project->id) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="Project name">프로젝트 명</label>
                <div>
                    <input type="text" class="form-control" name="name" value="{{ $project->name }}">
                </div>
            </div>

            <div class="form-group">
                <label for="설명">설명</label>
                <div>
                    <textarea class="form-control" rows="5" name="description">{{ $project->description }}</textarea>
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
                <div>
                    <button type="submit" class="btn btn-primary">
                        수정
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
