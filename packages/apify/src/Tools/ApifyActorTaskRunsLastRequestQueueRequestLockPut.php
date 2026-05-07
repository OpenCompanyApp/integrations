<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Prolong lock on request in last task run's default request queue.
 *
 * Executes the official Apify API operation actorTask_runs_last_requestQueue_request_lock_put.
 */
class ApifyActorTaskRunsLastRequestQueueRequestLockPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_request_queue_request_lock_put';
}
