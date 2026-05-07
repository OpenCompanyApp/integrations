<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Batch add requests to default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_requests_batch_post.
 */
class ApifyActorRunRequestQueueRequestsBatchPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_requests_batch_post';
}
