<?php

namespace App\Http\Controllers;

use App\Mission;
use App\Category;
use App\Http\Requests\CreateMission;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::all();

        return view('missions/index', [
            'missions' => $missions
        ]);
    }

    public function showCreateForm()
    {
        $categories = Category::all();

        return view('missions/create', [
            'categories' => $categories
        ]);
    }

    public function create(CreateMission $request)
    {
        $mission = new Mission();
        
        $mission->user_id = 1;
        $mission->category_id = $request->category_id;
        $mission->name = $request->name;
        $mission->score_unit = $request->score_unit;
        $mission->memo = $request->memo;
        
        $mission->save();

        return redirect()->route('missions.index');
    }

    public function detail(Mission $mission)
    {
        $steps = $mission->steps()->orderBy('date', 'DESC')->get();
        $steps_for_chart = $mission->steps()->orderBy('date', 'DESC')->take(10)->get();

        return view('missions/detail', [
            'mission' => $mission,
            'steps' => $steps,
            'steps_for_chart' => $steps_for_chart
        ]);
    }

}
