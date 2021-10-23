@extends('layouts.app')

@section('title')
프로젝트 목록
@endsection

@section('content')

    <div class="col-md-12">
        <p>
            <a href="{{ route('projects.create') }}" class="btn btn-success">프로젝트 생성</a>
        </p>
        @if(session()->has('message'))
        <div class="alert alert-info">
            {{session()->get('message')}}
        </div>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <td>프로젝트명</td>
                <td>설명</td>
                <td>생성일</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>
                    <a href="{{route('projects.show', [$project->id])}}">{{ $project->name }}</a>
                </td>
                <td>
                    {{ $project->description }}
                </td>
                <td>
                    {{ $project->created_at }}
                </td>
                <td>
                    <a class="btn btn-success" href="{{ route('projects.edit', $project->id) }}">편집</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('projects.destroy', $project->id) }}">
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
