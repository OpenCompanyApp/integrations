<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete last task run's default request queue.
 *
 * Executes the official Apify API operation actorTask_runs_last_requestQueue_delete.
 */
class ApifyActorTaskRunsLastRequestQueueDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_request_queue_delete';
}
