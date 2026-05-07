<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_put.
 */
class ApifyActRunsLastRequestQueuePut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_put';
}
