<?php

namespace App\Observers;

use App\Models\Models\Apiuser;

class ApiuserObserve
{
    /**
     * Handle the Apiuser "created" event.
     *
     * @param  \App\Models\Models\Apiuser  $apiuser
     * @return void
     */
    public function creating(Apiuser $apiuser)
    {
//        $apiuser->password=bcrypt(request()->get('password'));
        $apiuser->password=bcrypt($apiuser->password);
    }

    /**
     * Handle the Apiuser "updated" event.
     *
     * @param  \App\Models\Models\Apiuser  $apiuser
     * @return void
     */
    public function updated(Apiuser $apiuser)
    {
        //
    }

    /**
     * Handle the Apiuser "deleted" event.
     *
     * @param  \App\Models\Models\Apiuser  $apiuser
     * @return void
     */
    public function deleted(Apiuser $apiuser)
    {
        //
    }

    /**
     * Handle the Apiuser "restored" event.
     *
     * @param  \App\Models\Models\Apiuser  $apiuser
     * @return void
     */
    public function restored(Apiuser $apiuser)
    {
        //
    }

    /**
     * Handle the Apiuser "force deleted" event.
     *
     * @param  \App\Models\Models\Apiuser  $apiuser
     * @return void
     */
    public function forceDeleted(Apiuser $apiuser)
    {
        //
    }
}
