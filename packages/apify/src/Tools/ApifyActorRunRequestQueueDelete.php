<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_delete.
 */
class ApifyActorRunRequestQueueDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_delete';
}
