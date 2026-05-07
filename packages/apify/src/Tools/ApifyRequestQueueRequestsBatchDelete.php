<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete requests.
 *
 * Executes the official Apify API operation requestQueue_requests_batch_delete.
 */
class ApifyRequestQueueRequestsBatchDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_requests_batch_delete';
}
