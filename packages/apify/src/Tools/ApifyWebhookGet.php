<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get webhook.
 *
 * Executes the official Apify API operation webhook_get.
 */
class ApifyWebhookGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_webhook_get';
}
