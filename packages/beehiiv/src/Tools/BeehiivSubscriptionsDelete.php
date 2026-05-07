<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Delete subscription OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation subscriptions_delete.
 */
class BeehiivSubscriptionsDelete extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_delete';
}
