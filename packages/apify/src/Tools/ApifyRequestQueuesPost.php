<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Create request queue.
 *
 * Executes the official Apify API operation requestQueues_post.
 */
class ApifyRequestQueuesPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_request_queues_post';
}
