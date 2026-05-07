<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Unlock requests.
 *
 * Executes the official Apify API operation requestQueue_requests_unlock_post.
 */
class ApifyRequestQueueRequestsUnlockPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_requests_unlock_post';
}
