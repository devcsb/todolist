<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Project::factory(50)->create();

        $array = [    // 1
            '개인' => '개인적으로 할 일',
            '작업' => '업무 목록',
            '심부름' => '심부름',
            '쇼핑' => '사야할 것들',
        ];

        $users = User::all();

        foreach ($users as $user) {
            foreach($array as $name => $desc){
                $project = Project::factory(1)
                    ->create([
                        'name'=>$name,
                        'description'=>$desc,
                        'user_id'=>$user->id,
                    ]);

                foreach(Task::factory(3)->make() as $task){
                    $project2=Project::find($user->id);
                    $project2->tasks()->save($task);
                    //Potentially polymorphic call. The code may be inoperable depending on the actual class instance passed as the argument.
                    //에러 발생하여 새로 project2변수에 팩토리로 생성한 project값 가져왔음.
                }

            }
        }
    }
}
