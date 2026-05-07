<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Test webhook OAuth Scope: webhooks:read.
 *
 * Executes the official beehiiv API operation webhooks_test.
 */
class BeehiivWebhooksTest extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_webhooks_test';
}
