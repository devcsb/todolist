<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    protected $dates = ['due_date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeDueIndDays($query, $days)
    {
        $now = now();
        return $query->where('due_date','>',$now)
            ->where('due_date','<',$now->copy()->addDays($days));
        //곧바로 $now->addDays($days)처럼 계산해버리면, 기존 인스턴스 자체가 바뀌므로,
        //$now->copy()->addDays($days)처럼 객체를 복사하는 copy() 메서드를 호출해서 인스턴스를 복제후 사용한다.
    }
}
