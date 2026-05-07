<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get request from last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_request_get.
 */
class ApifyActRunsLastRequestQueueRequestGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_request_get';
}
