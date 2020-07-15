<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StepController extends Controller
{
    public function index()
    {
        return "index";
    }

    public function showCreateForm()
    {
        return "showCreateForm";
    }

    public function showEditForm()
    {
        return "showEditForm";
    }

}
