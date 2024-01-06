@extends('layouts.app')

@section('title', 'The list of task')

@section('content')

<div>
        <nav class="mb-4">
            <a href="{{ route('task.create') }}" class="link">Add Task</a>
        </nav>
        <ul>
            @forelse($tasks as $task)
                <li><a href="{{ route('task.show', ['task'=>$task->id]) }}"
                       @class(['line-through'=>$task->completed])
                    >{{ $task->title }}</a></li>
            @empty
                <li>No task available</li>
            @endforelse
        </ul>
    @if($tasks->count())
        <nav class="mb-4">
            {{ $tasks->links() }}
        </nav>
    @endif

</div>
@endsection
