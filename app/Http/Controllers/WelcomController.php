<?php

namespace App\Http\Controllers;

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

    public function index()  //2
    {
        // 3 사용자, 프로젝트, 태스트 수 가져오기. 아직 모델을 생성하지 않았으므로 0 으로 설정
        $uc = 0; //User::count();
        $pc = 0; //Project::count();
        $tc = 0; //Task::count();

        $total = ['user' => $uc,
            'project' => $pc,
            'task' => $tc,
        ];
        return view('welcome')->with('total', $total);
    }
}
