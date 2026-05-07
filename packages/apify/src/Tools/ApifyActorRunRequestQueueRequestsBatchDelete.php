<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Batch delete requests from default request queue.
 *
 * Executes the official Apify API operation actorRun_requestQueue_requests_batch_delete.
 */
class ApifyActorRunRequestQueueRequestsBatchDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_requests_batch_delete';
}
