<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get and lock last task run's default request queue head.
 *
 * Executes the official Apify API operation actorTask_runs_last_requestQueue_head_lock_post.
 */
class ApifyActorTaskRunsLastRequestQueueHeadLockPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_request_queue_head_lock_post';
}
