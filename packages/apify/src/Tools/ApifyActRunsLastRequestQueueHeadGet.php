<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run's default request queue head.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_head_get.
 */
class ApifyActRunsLastRequestQueueHeadGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_head_get';
}
