<?php

use Spectacular\Core\Http\Controllers\Api\FeaturesController;
use Spectacular\Core\Http\Controllers\Api\ProjectsController;
use Spectacular\Core\Http\Controllers\Api\UnknownsController;
use Spectacular\Core\Http\Controllers\Api\RequirementsController;
use Spectacular\Core\Http\Controllers\Api\TasksController;
use Spectacular\Core\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::controller(FeaturesController::class)->group(function () {
    Route::post('features/{feature}/edit', 'update')->name('api.features.edit');
    Route::post('features/add', 'store')->name('api.features.add');
    Route::post('features/{feature}/delete', 'delete')->name('api.features.delete');
});

Route::controller(ProjectsController::class)->group(function () {
     Route::get('projects/browse', 'index')->name('api.projects.browse');
    Route::post('projects/add', 'store')->name('api.projects.add');
     Route::get('projects/{project}/read', 'show')->name('api.projects.read');
    Route::post('projects/{project}/edit', 'update')->name('api.projects.edit');
    Route::post('projects/{project}/delete', 'delete')->name('api.projects.delete');
    Route::post('projects/{project}/organise', 'organise')->name('api.projects.organise');
});

Route::controller(UnknownsController::class)->group(function () {
    Route::post('unknowns/{unknown}/edit', 'update')->name('api.unknowns.edit');
    Route::post('unknowns/add', 'store')->name('api.unknowns.add');
    Route::post('unknowns/{unknown}/delete', 'delete')->name('api.unknowns.delete');
});

Route::controller(RequirementsController::class)->group(function () {
    Route::post('requirements/{requirement}/edit', 'update')->name('api.requirements.edit');
    Route::post('requirements/add', 'store')->name('api.requirements.add');
    Route::post('requirements/{requirement}/delete', 'delete')->name('api.requirements.delete');
    Route::post('requirements/{requirement}/tasks/complete', 'completeTasks')->name('api.requirements.tasks.complete');
});

Route::controller(TasksController::class)->group(function () {
    Route::post('tasks/{task}/edit', 'update')->name('api.tasks.edit');
    Route::post('tasks/add', 'store')->name('api.tasks.add');
    Route::post('tasks/{task}/delete', 'delete')->name('api.tasks.delete');
});

Route::controller(UsersController::class)->group(function () {
    Route::post('users/add', 'store')->name('api.users.add');
    Route::post('users/{user}/edit', 'update')->name('api.users.edit');
    Route::post('users/{user}/delete', 'delete')->name('api.users.delete');
});
