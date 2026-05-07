<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get head.
 *
 * Executes the official Apify API operation requestQueue_head_get.
 */
class ApifyRequestQueueHeadGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_head_get';
}
