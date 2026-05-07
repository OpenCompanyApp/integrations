<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete request queue.
 *
 * Executes the official Apify API operation requestQueue_delete.
 */
class ApifyRequestQueueDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_delete';
}
