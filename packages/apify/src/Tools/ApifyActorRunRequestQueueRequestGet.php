<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get request from default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_request_get.
 */
class ApifyActorRunRequestQueueRequestGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_request_get';
}
