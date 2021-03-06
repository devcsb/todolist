@extends('layouts.app')

@section('title')
    태스크 목록
@endsection

@section('content')

    <div class="col-md-12">
        <h3>프로젝트 명: {{ $project->name }}</h3>
        <p>
            <a href="{{ route('projects.tasks.create', [$project->id]) }}" class="btn btn-success">tasks 생성</a>
        </p>

        @if(Session::has('message'))
            <div class="alert alert-info">
                {{Session::get('message')}}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <td>이름</td>
                <td>우선순위</td>
                <td>상태</td>
                <td>기한</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>
                        <a href="{{route('projects.tasks.show', [$project->id, $task->id])}}">{{ $task->name }}</a>
                    </td>
                    <td>
                        {{ $task->priority }}
                    </td>
                    <td>
                        {{ $task->status }}
                    </td>
                    <td>
                        {{ $task->due_date }}
                    </td>
                    <td>
                        <a class="btn btn-success"
                           href="{{ route('projects.tasks.edit', [$project->id, $task->id]) }}">편집</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('projects.tasks.destroy', [$project->id, $task->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                삭제
                            </button>
                        </form>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection
