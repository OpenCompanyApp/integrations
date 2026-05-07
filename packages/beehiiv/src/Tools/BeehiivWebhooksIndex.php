<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List webhooks OAuth Scope: webhooks:read.
 *
 * Executes the official beehiiv API operation webhooks_index.
 */
class BeehiivWebhooksIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_webhooks_index';
}
