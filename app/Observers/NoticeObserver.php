<?php

namespace App\Observers;

use App\Jobs\MarkLogs;
use App\Models\Models\Notice;

class NoticeObserver
{
    /**
     * Handle the Notice "created" event.
     *
     * @param  \App\Models\Models\Notice  $notice
     * @return void
     */
    public function created(Notice $notice)
    {
        \Log::info('=============添加了==============');
//        发布一个任务
        dispatch(new MarkLogs());
    }

    /**
     * Handle the Notice "updated" event.
     *
     * @param  \App\Models\Models\Notice  $notice
     * @return void
     */
    public function updated(Notice $notice)
    {
        //
    }

    /**
     * Handle the Notice "deleted" event.
     *
     * @param  \App\Models\Models\Notice  $notice
     * @return void
     */
    public function deleted(Notice $notice)
    {
        //
    }

    /**
     * Handle the Notice "restored" event.
     *
     * @param  \App\Models\Models\Notice  $notice
     * @return void
     */
    public function restored(Notice $notice)
    {
        //
    }

    /**
     * Handle the Notice "force deleted" event.
     *
     * @param  \App\Models\Models\Notice  $notice
     * @return void
     */
    public function forceDeleted(Notice $notice)
    {
        //
    }
}
