<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update request queue.
 *
 * Executes the official Apify API operation requestQueue_put.
 */
class ApifyRequestQueuePut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_put';
}
