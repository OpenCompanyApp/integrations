<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Add requests.
 *
 * Executes the official Apify API operation requestQueue_requests_batch_post.
 */
class ApifyRequestQueueRequestsBatchPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queue_requests_batch_post';
}
