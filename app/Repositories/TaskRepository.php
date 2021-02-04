<?php

namespace App\Repositories;

use App\Task;
use App\Tag;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function all()
    {
        return Task::with('status', 'priority', 'tags')->get();
    }

    public function getById($id)
    {
        return Task::find($id);
    }

    public function store(array $attributes)
    {
        $task = Task::create([
            'title' => $attributes['title'],
            'priority_id' => $attributes['priority'],
            'status_id' => $attributes['status']
            ]);
        if(isset($attributes['tags'])) {
            $tags = collect($attributes['tags']);
            $tags->each(function ($item) use ($task) {
                $tag = Tag::firstOrCreate(['title' => $item['text']]);
                $task->tags()->syncWithoutDetaching($tag);
            });
        }
    }

    public function update(array $attributes, Task $task)
    {
        $task->update([
            'title' => $attributes['title'], 
            'priority_id' => isset($attributes['priority']['id']) ? $attributes['priority']['id'] : $attributes['priority'],
            'status_id' => isset($attributes['status']['id']) ? $attributes['status']['id'] : $attributes['status'],
            ]);

        $task->tags()->sync([]);

        if(isset($attributes['tags'])) {
            $task->tags()->sync([]);
            $tags = collect($attributes['tags']);
            $tags->each(function ($item) use ($task) {
                $tag = Tag::firstOrCreate(['title' => $item['text']]);
                $task->tags()->syncWithoutDetaching($tag);
            });
        }
    }

}