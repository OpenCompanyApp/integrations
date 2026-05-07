<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get webhook OAuth Scope: webhooks:read.
 *
 * Executes the official beehiiv API operation webhooks_show.
 */
class BeehiivWebhooksShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_webhooks_show';
}
