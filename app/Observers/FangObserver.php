<?php

namespace App\Observers;

use App\Models\Models\Fang;
use Illuminate\Support\Facades\Log;

class FangObserver
{
    /**
     * Handle the Fang "created" event.
     *
     * @param  \App\Models\Models\Fang  $fang
     * @return void
     */
    public function created(Fang $fang)
    {
        Log::info('===========创建了======='.json_encode($fang,JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Fang "updated" event.
     *
     * @param  \App\Models\Models\Fang  $fang
     * @return void
     */
    public function updated(Fang $fang)
    {
        //
    }

    /**
     * Handle the Fang "deleted" event.
     *
     * @param  \App\Models\Models\Fang  $fang
     * @return void
     */
    public function deleted(Fang $fang)
    {
        //
    }

    /**
     * Handle the Fang "restored" event.
     *
     * @param  \App\Models\Models\Fang  $fang
     * @return void
     */
    public function restored(Fang $fang)
    {
        //
    }

    /**
     * Handle the Fang "force deleted" event.
     *
     * @param  \App\Models\Models\Fang  $fang
     * @return void
     */
    public function forceDeleted(Fang $fang)
    {
        //
    }
}
