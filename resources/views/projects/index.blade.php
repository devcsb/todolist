@extends('layouts.app')

@section('title')
프로젝트 목록
@endsection

@section('content')

    <div class="col-md-12">
        <p>
            <a href="{{ route('projects.create') }}" class="btn btn-success">프로젝트 생성</a>
        </p>
        @if(Session::has('message'))  // 3
        <div class="alert alert-info">
            {{Session::get('message')}}
        </div>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <td>이름</td>
                <td>Description</td>
                <td>생성일</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)	// 4
            <tr>
                <td>
                    <a href="{{route('projects.show', [$project->id])}}">{{ $proj->name }}</a>	//5
                </td>
                <td>
                    {{ $project->description }}
                </td>
                <td>
                    {{ $project->created_at }}
                </td>
                <td>
                    <a class="btn btn-success" href="{{ route('projects.edit', $project->id) }}">편집</a>  // 6
                </td>
                <td>
                    <a class="btn btn-danger" href="{{ route('projects.destroy', $project->id) }}">삭제</a> //7
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
