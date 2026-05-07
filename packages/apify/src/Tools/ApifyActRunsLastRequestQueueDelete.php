<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete last run's default request queue.
 *
 * Executes the official Apify API operation act_runs_last_requestQueue_delete.
 */
class ApifyActRunsLastRequestQueueDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_request_queue_delete';
}
