<?php

namespace App\Observers;

use App\Events\ResultSubmittedEvent;
use App\Jobs\ResultSubmittedJob;
use App\Result;
use Ramsey\Uuid\Uuid;

class ResultObserver
{

    public function saving(Result $result)
    {
        if (!$result->uuid) {
            $result->uuid = Uuid::uuid4()->toString();
        }
    }

    public function created(Result $result)
    {
        $result->saveImageToStorage();

        // Publish processing event
        $job = new ResultSubmittedJob($result);
        dispatch($job);

        $event = new ResultSubmittedEvent($result);
        event($event);
    }
}
