<?php

namespace App\Observers;

use App\Models\Evento;
use Illuminate\Support\Facades\Cache;

class EventosObserver
{
    /**
     * Handle the Eventos "created" event.
     */
    public function created(Evento $eventos): void
    {
        Cache::forget('eventos_todo');
    }

    /**
     * Handle the Eventos "updated" event.
     */
    public function updated(Evento $eventos): void
    {
        Cache::forget('eventos_todo');
    }

    /**
     * Handle the Eventos "deleted" event.
     */
    public function deleted(Evento $eventos): void
    {
        Cache::forget('eventos_todo');
    }

    /**
     * Handle the Eventos "restored" event.
     */
    public function restored(Evento $eventos): void
    {
    
    }

    /**
     * Handle the Eventos "force deleted" event.
     */
    public function forceDeleted(Evento $eventos): void
    {
        //
    }
}
