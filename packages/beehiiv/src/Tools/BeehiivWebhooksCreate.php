<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Create a webhook OAuth Scope: webhooks:write.
 *
 * Executes the official beehiiv API operation webhooks_create.
 */
class BeehiivWebhooksCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_webhooks_create';
}
