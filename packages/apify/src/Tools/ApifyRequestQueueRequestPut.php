<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update request.
 *
 * Executes the official Apify API operation requestQueue_request_put.
 */
class ApifyRequestQueueRequestPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_request_put';
}
