<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of webhooks.
 *
 * Executes the official Apify API operation act_webhooks_get.
 */
class ApifyActWebhooksGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_webhooks_get';
}
