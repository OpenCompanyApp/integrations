<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Add request to last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_requests_post.
 */
class ApifyActRunsLastRequestQueueRequestsPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_requests_post';
}
