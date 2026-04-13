<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class ModelObserver
{
    public function creating($model)
    {
        if (auth()->check()) {
            $model->created_by = Auth::id();
        }
    }

    public function updating($model)
    {
        if (auth()->check()) {
            $model->updated_by = Auth::id();
        }
    }

    public function deleting($model)
    {
        if (! $model->isForceDeleting() && auth()->check()) {
            $model->deleted_by = Auth::id();
            $model->saveQuietly(); // évite boucle infinie 🔥
        }
    }
}