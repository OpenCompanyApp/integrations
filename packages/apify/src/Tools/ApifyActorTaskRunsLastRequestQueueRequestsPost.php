<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Add request to last task run's default request queue.
 *
 * Executes the official Apify API operation actorTask_runs_last_requestQueue_requests_post.
 */
class ApifyActorTaskRunsLastRequestQueueRequestsPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_request_queue_requests_post';
}
