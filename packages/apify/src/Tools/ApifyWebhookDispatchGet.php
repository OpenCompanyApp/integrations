<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get webhook dispatch.
 *
 * Executes the official Apify API operation webhookDispatch_get.
 */
class ApifyWebhookDispatchGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_webhook_dispatch_get';
}
