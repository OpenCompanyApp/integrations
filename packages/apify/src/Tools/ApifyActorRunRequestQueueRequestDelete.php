<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete request from default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_request_delete.
 */
class ApifyActorRunRequestQueueRequestDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_request_delete';
}
