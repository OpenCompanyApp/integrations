<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get default request queue head.
 *
 * Executes the official Apify API operation actorRun_requestQueue_head_get.
 */
class ApifyActorRunRequestQueueHeadGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_head_get';
}
