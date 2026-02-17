<?php

use Spectacular\Core\Http\Controllers\Api\FeaturesController;
use Spectacular\Core\Http\Controllers\Api\ProjectsController;
use Spectacular\Core\Http\Controllers\Api\UnknownsController;
use Spectacular\Core\Http\Controllers\Api\RequirementsController;
use Spectacular\Core\Http\Controllers\Api\TasksController;
use Spectacular\Core\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::controller(FeaturesController::class)->group(function () {
    Route::post('features/{feature}/edit', 'update');
    Route::post('features/add', 'store');
    Route::post('features/{feature}/delete', 'destroy');
});

Route::controller(ProjectsController::class)->group(function () {
     Route::get('projects/browse', 'index');
    Route::post('projects/add', 'store');
     Route::get('projects/{project}/read', 'show');
    Route::post('projects/{project}/edit', 'update');
    Route::post('projects/{project}/delete', 'destroy');
    Route::post('projects/{project}/organise', 'organise');
});

Route::controller(UnknownsController::class)->group(function () {
    Route::post('unknowns/{unknown}/edit', 'update');
    Route::post('unknowns/add', 'store');
    Route::post('unknowns/{unknown}/delete', 'destroy');
});

Route::controller(RequirementsController::class)->group(function () {
    Route::post('requirements/{requirement}/edit', 'update');
    Route::post('requirements/add', 'store');
    Route::post('requirements/{requirement}/delete', 'destroy');
    Route::post('requirements/{requirement}/tasks/complete', 'completeTasks');
});

Route::controller(TasksController::class)->group(function () {
    Route::post('tasks/{task}/edit', 'update');
    Route::post('tasks/add', 'store');
    Route::post('tasks/{task}/delete', 'destroy');
});

Route::controller(UsersController::class)->group(function () {
    Route::post('users/add', 'store');
    Route::post('users/{user}/edit', 'update');
    Route::post('users/{user}/delete', 'destroy');
});
