<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId); //프로젝트 정보 가져오기
        $tasks = $project->tasks()->get();

        return view('projects.tasks.index', compact('project', 'tasks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('projects.tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $projectId)
    {
        $task = new Task([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'priority' => $request->get('priority'),
            'status' => $request->get('status'),
            'due_date' => $request->get('due_date'),
        ]);

        $task->project()->associate($projectId); //task를 현재 프로젝트와 연결.
        $task->save();  //task를 db에 저장.

        return redirect()->route('projects.tasks.index', $task->project->id)->with('message', $task->name . ' (이)가 생성되었습니다.');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);
        $task = Task::find($taskId);
        if ($task === null) {
            abort(404, $taskId . '번 프로젝트를 찾을 수가 없습니다.'); // message 설정 위하여 이같은 방식 사용.
        }

        return view('projects.tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);

        $task = Task::findOrFail($taskId);

        return view('projects.tasks.edit', compact('project','task'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectId, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $task->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'priority' => $request->get('priority'),
            'status' => $request->get('status'),
            'due_date' => $request->get('due_date'),
        ]);

        return redirect()->route('projects.tasks.index', $task->project->id)->with('message', $task->name . ' (이)가 정상적으로 수정 되었습니다.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();
        return redirect()->route('projects.tasks.index', $task->project->id)->with('message', $task->name . ' (이)가 정상적으로 삭제 되었습니다.');

    }
}
