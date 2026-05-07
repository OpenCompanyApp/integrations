<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get head and lock.
 *
 * Executes the official Apify API operation requestQueue_head_lock_post.
 */
class ApifyRequestQueueHeadLockPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_head_lock_post';
}
