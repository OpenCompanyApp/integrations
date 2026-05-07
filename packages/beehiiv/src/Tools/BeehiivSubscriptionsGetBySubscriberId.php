<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get subscription by subscriber ID OAuth Scope: subscriptions:read.
 *
 * Executes the official beehiiv API operation subscriptions_get-by-subscriber-id.
 */
class BeehiivSubscriptionsGetBySubscriberId extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_get_by_subscriber_id';
}
