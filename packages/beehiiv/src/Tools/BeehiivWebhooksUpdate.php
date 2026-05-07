<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update webhook OAuth Scope: webhooks:write.
 *
 * Executes the official beehiiv API operation webhooks_update.
 */
class BeehiivWebhooksUpdate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_webhooks_update';
}
