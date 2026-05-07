<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * List last run's default request queue's requests.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_requests_get.
 */
class ApifyActRunsLastRequestQueueRequestsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_requests_get';
}
