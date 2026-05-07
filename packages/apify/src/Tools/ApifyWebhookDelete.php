<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete webhook.
 *
 * Executes the official Apify API operation webhook_delete.
 */
class ApifyWebhookDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_webhook_delete';
}
