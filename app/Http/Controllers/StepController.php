<?php

namespace App\Http\Controllers;

use App\Mission;
use App\Step;
use App\Http\Requests\CreateStep;

class StepController extends Controller
{
    public function create(Mission $mission, CreateStep $request)
    {
        $step = new Step();
        
        $step->mission_id = $request->mission_id;
        $step->date = $request->date;
        $step->score = $request->score;
        $step->memo = $request->memo;
        
        $mission->steps()->save($step);

        return redirect()->route('missions.detail', ['mission' => $mission])->with('message', 'ステップを追加しました。');
    }

    public function showEditForm()
    {
        return "showEditForm";
    }

}
