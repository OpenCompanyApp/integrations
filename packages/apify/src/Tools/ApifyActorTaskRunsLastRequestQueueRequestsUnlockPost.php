<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Unlock requests in last task run's default request queue.
 *
 * Executes the official Apify API operation actorTask_runs_last_requestQueue_requests_unlock_post.
 */
class ApifyActorTaskRunsLastRequestQueueRequestsUnlockPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_request_queue_requests_unlock_post';
}
