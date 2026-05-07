<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Create webhook.
 *
 * Executes the official Apify API operation webhooks_post.
 */
class ApifyWebhooksPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_webhooks_post';
}
