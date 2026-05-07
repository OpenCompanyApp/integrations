<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete request lock.
 *
 * Executes the official Apify API operation requestQueue_request_lock_delete.
 */
class ApifyRequestQueueRequestLockDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_request_lock_delete';
}
