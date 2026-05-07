<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of webhook dispatches.
 *
 * Executes the official Apify API operation webhookDispatches_get.
 */
class ApifyWebhookDispatchesGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_webhook_dispatches_get';
}
