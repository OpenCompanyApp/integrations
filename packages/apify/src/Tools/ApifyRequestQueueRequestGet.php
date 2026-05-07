<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get request.
 *
 * Executes the official Apify API operation requestQueue_request_get.
 */
class ApifyRequestQueueRequestGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_request_get';
}
