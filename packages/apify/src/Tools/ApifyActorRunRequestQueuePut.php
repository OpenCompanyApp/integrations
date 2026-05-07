<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_put.
 */
class ApifyActorRunRequestQueuePut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_put';
}
