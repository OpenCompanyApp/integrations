<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update request in default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_request_put.
 */
class ApifyActorRunRequestQueueRequestPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_request_put';
}
