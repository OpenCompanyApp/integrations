<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get request queue.
 *
 * Executes the official Apify API operation requestQueue_get.
 */
class ApifyRequestQueueGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_get';
}
