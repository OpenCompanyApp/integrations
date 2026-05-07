<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get and lock default request queue head.
 *
 * Executes the official Apify API operation actorRun_requestQueue_head_lock_post.
 */
class ApifyActorRunRequestQueueHeadLockPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_head_lock_post';
}
