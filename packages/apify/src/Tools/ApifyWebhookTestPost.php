<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Test webhook.
 *
 * Executes the official Apify API operation webhook_test_post.
 */
class ApifyWebhookTestPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_webhook_test_post';
}
