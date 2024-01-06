@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mb-4">
        <a href="{{ route('task.index') }}"
           class="link">
            < Back to the list of task
        </a>
    </div>

    <p class="mb-4 text-state-700">{{$task->description}}</p>

    @if($task->long_description)
        <p class="mb-4 text-state-700">{{$task->long_description}}</p>
    @endif

    <p class="mb-4 text-sm text-slate-500">
        Created {{ $task->created_at->diffForHumans() }}
        |
        Updated {{ $task->updated_at->diffForHumans() }}</p>
    <p>
        @if($task->completed)
            <span class="font-medium text-green-500">completed</span>
        @else
            <span class="font-medium text-red-500">not completed</span>
        @endif
    </p>
    <div class="flex gap-2">
        <a href="{{ route('task.edit', ['task'=>$task]) }}"
           class="btn"
        >
            Edit
        </a>
        <form method="POST" action="{{ route('task.toggle-complete',['task'=>$task] ) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="btn">
                {{ $task->completed ? 'mark as uncompleted' : 'mark as completed' }}
            </button>
        </form>

        <form action="{{ route('task.destroy', ['task'=>$task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">delete task</button>
        </form>
    </div>
@endsection
