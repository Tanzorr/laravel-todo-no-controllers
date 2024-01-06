@extends('layouts.app')

@section('title', isset($task) ? 'Edit task':'Create a task')

@section('styles')
    <style>
        .error-message {
            color: red;
            font-size: .8rem;
        }
    </style>
@endsection

@section('content')
    <form action="{{isset($task)
   ? route('task.update', ['task'=>$task->id])
   : route('task.store') }}" method='post'
    class="flex flex-col gap-4 w-1/2 mx-auto"
    >
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div>
            <label for="title">Title</label>
            <input type="text"
                   name="title"
                   id="title"
                   value="{{ $task->title ?? old('title') }}"
                   @class(['border-red-500'=>$errors->has('title')])
            >
            @error('title')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description"
                      id="description"
                      rows="5"
                      @class(['border-red-500'=>$errors->has('description')])
            >
                {{$task->description ??  old('description') }}
            </textarea>
            @error('description')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description"
                      id="long_description"
                      rows="10"
                      @class(['border-red-500'=>$errors->has('long_description')])
            >
                 {{$task->long_description ??  old('long_description') }}
            </textarea>
            @error('long_description')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex gap-2 items-center">
            <button type="submit" class="btn">
                @isset($task)
                    edit task
                @else
                    add task
                @endisset
            </button>
            <a href="{{ route('task.index') }}" class="link">Cancel</a>
        </div>
    </form>
@endsection

