<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete request.
 *
 * Executes the official Apify API operation requestQueue_request_delete.
 */
class ApifyRequestQueueRequestDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_request_delete';
}
