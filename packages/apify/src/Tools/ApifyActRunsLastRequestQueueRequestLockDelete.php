<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete lock on request in last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_request_lock_delete.
 */
class ApifyActRunsLastRequestQueueRequestLockDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_request_lock_delete';
}
