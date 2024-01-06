<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    $tasks = Task::paginate(15);
    return view('index', ['tasks' => $tasks]);
})->name('task.index');

Route::view('/tasks/create', 'create')->name('task.create');

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::paginate(5)
    ]);
})->name('task.index');

Route::get('/task/{task}', function (Task $task)  {
    return view('task', ['task' => $task]);
})->name('task.show');

Route::get('/task/{task}/edit', function (Task $task)  {
    return view('edit', ['task' => $task]);
})->name('task.edit');

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());
    $task->save();

    return redirect()->route('task.show', ['task' => $task->id])
        ->with('success', 'Task created successfully.');
})->name('task.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully.');
})->name('task.update');


Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('task.index')
        ->with('success', 'Task deleted successfully.');
})->name('task.destroy');

Route::put('tasks/{task}/complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task completed successfully.');

})->name('task.toggle-complete');

Route::fallback(function(){
    return "Sorry, the page you are looking for could not be found.";
});
