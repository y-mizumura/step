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
        $mission->level_unit = $request->level_unit;
        $mission->memo = $request->memo;
        
        $mission->save();

        return redirect()->route('missions.index');
    }

}
