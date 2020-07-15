<?php

namespace App\Http\Controllers;

use App\Mission;
use Illuminate\Http\Request;

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
        return "showCreateForm";
    }

}
