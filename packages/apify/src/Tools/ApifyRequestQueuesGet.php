<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of request queues.
 *
 * Executes the official Apify API operation requestQueues_get.
 */
class ApifyRequestQueuesGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queues_get';
}
