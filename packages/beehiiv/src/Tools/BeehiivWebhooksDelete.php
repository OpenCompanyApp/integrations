<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Delete a webhook OAuth Scope: webhooks:write.
 *
 * Executes the official beehiiv API operation webhooks_delete.
 */
class BeehiivWebhooksDelete extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_webhooks_delete';
}
