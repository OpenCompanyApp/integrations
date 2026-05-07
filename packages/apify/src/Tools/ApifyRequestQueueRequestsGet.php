<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * List requests.
 *
 * Executes the official Apify API operation requestQueue_requests_get.
 */
class ApifyRequestQueueRequestsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_requests_get';
}
