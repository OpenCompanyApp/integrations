<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Add request to default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_requests_post.
 */
class ApifyActorRunRequestQueueRequestsPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_requests_post';
}
