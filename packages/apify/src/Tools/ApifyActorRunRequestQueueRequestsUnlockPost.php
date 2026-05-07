<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Unlock requests in default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_requests_unlock_post.
 */
class ApifyActorRunRequestQueueRequestsUnlockPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_requests_unlock_post';
}
