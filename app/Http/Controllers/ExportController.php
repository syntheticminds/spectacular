<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;

class ExportController extends Controller
{
    public function html(Project $project): Response
    {
        $project->loadAll();

        return response()->view('export.html', compact('project'));
    }

    public function markdown(Project $project): Response
    {
        $project->loadAll();

        return response()->view('export.markdown', compact('project'))->header('Content-Type', 'text/markdown');
    }
}
