<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Batch add requests to last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_requests_batch_post.
 */
class ApifyActRunsLastRequestQueueRequestsBatchPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_requests_batch_post';
}
