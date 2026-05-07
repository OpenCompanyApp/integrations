<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete lock on request in default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_request_lock_delete.
 */
class ApifyActorRunRequestQueueRequestLockDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_request_lock_delete';
}
