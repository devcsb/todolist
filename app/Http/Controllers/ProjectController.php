<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = auth()->user();
        $projects = Project::where('user_id', $user->id)->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $project = new Project([
//          'name' => $request->get('name'),
//          'description'=> $request->get('description'),
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);
        $user = auth()->user();
        $project->user()->associate($user->id);
        $project->save();
        $message = $project->name . '이 성공적으로 생성되었습니다.';

        //redirect()->route()수행시, compact()로 담아 보내면 쿼리 스트링으로 담겨보내지지만, with()로 보내면 세션에 실어 보낸다.
        return redirect()->route('projects.index')->with('message', $project->name . ' 프로젝트가 성공적으로 생성되었습니다.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $project = Project::findOrFail($id);  // fail시 404 에러가 뜸
        $project = Project::find($id);
        if ($project === null) {
            abort(404, $id . '번 프로젝트를 찾을 수가 없습니다.'); // message 설정 위하여 이같은 방식 사용.
        }

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        //$project->update($request->all()) 처럼 사용자 입력값 그대로 다 쓰는 방법 절대 금지. 아래 $request->get('name') 처럼 하나하나 지정할 것
        $project->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('projects.index')->with('message', $project->name . ' 프로젝트가 성공적으로 수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        foreach($project->tasks()->get() as $task)
        {
            $task->delete();
        }
        $project->delete();

        return redirect()->route('projects.index')->with('message', '프로젝트 '.$project->name.' 이 삭제되었습니다.');
    }
}
