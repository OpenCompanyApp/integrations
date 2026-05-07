<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_get.
 */
class ApifyActRunsLastRequestQueueGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_get';
}
