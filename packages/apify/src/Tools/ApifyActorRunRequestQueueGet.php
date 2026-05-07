<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_get.
 */
class ApifyActorRunRequestQueueGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_get';
}
