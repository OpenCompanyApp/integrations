<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of webhooks.
 *
 * Executes the official Apify API operation webhooks_get.
 */
class ApifyWebhooksGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_webhooks_get';
}
