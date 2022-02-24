<?php

use Code\Builder\Http\Controllers\PageController;
use Code\Builder\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for Package. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Backend
Route::get('/builder/page', [PageController::class,'index'])->name('page.index');
Route::get('/page/create',[PageController::class,'create'])->name('page.create');
Route::post('/page/store',[PageController::class,'store'])->name('page.store');
Route::get('/page/{id}/edit',[PageController::class,'edit'])->name('page.edit');
Route::post('/page/{id}/update',[PageController::class,'update'])->name('page.update');
Route::get('/page/{id}/delete',[PageController::class,'destroy'])->name('page.delete');

//Template
Route::get('/templates',[TemplateController::class,'index'])->name('templates');
Route::get('/template/show',[TemplateController::class,'show'])->name('template.show');
Route::post('/template/store',[TemplateController::class,'store'])->name('template.store');
Route::post('/template/{id}/update',[TemplateController::class,'update'])->name('template.update');
Route::get('/template/{id}/design',[TemplateController::class,'design'])->name('template.design');
Route::post('/template/design/store',[TemplateController::class,'storeDesign'])->name('template.store.design');
Route::post('/template/activate',[TemplateController::class,'activateTemplate'])->name('template.activate');


//FrontEnd
Route::get('/page/{slug}', [PageController::class,'show'])->name('page');
