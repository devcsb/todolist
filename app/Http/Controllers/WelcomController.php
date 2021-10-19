<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * 세션 정보를 사용하기 위해 web 미들웨어 그룹 지정
 * phpDoc 형식으로 메소드명, 파라미터, 리턴타입을 적는 습관을 들이자. 주석에 타입을 명시하면 잘못된 사용시 IDE에서 경고를 내줌
 * @return void
 */
class WelcomController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        $userCount = User::count();	// 1
        $projectCount= Project::count();	//2
        $taskCount= Task::count();	//3

        $total = [ 'user' => $userCount,
            'project' => $projectCount,
            'task' => $taskCount,
        ];
        return view('welcome')->with('total', $total);
    }
}
