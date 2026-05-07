<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Unlock requests in last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_requests_unlock_post.
 */
class ApifyActRunsLastRequestQueueRequestsUnlockPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_requests_unlock_post';
}
