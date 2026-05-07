<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Create subscription OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation subscriptions_create.
 */
class BeehiivSubscriptionsCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_create';
}
