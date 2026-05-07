<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update subscription by ID OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation subscriptions_patch.
 */
class BeehiivSubscriptionsPatch extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_patch';
}
