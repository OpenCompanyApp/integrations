<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Batch add requests to last task run's default request queue.
 *
 * Executes the official Apify API operation actorTask_runs_last_requestQueue_requests_batch_post.
 */
class ApifyActorTaskRunsLastRequestQueueRequestsBatchPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_request_queue_requests_batch_post';
}
