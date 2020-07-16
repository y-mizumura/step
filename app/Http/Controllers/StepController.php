<?php

namespace App\Http\Controllers;

use App\Mission;
use App\Step;
use App\Http\Requests\CreateStep;
use App\Http\Requests\EditStep;

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

    public function showEditForm(Mission $mission, Step $step)
    {
        return view('steps/edit', [
            'mission' => $mission,
            'step' => $step
        ]);
    }

    public function edit(Mission $mission, Step $step, EditStep $request)
    {
        $step->score = $request->score;
        $step->memo = $request->memo;
        $step->save();

        return redirect()->route('missions.detail', [
            'mission' => $mission
        ])->with('message', 'ステップを更新しました。');
    }

}
