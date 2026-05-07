<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update request in last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_request_put.
 */
class ApifyActRunsLastRequestQueueRequestPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_request_put';
}
