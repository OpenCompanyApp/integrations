<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Prolong request lock.
 *
 * Executes the official Apify API operation requestQueue_request_lock_put.
 */
class ApifyRequestQueueRequestLockPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_request_lock_put';
}
