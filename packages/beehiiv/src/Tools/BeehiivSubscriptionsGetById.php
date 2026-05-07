<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get subscription by ID OAuth Scope: subscriptions:read.
 *
 * Executes the official beehiiv API operation subscriptions_get-by-id.
 */
class BeehiivSubscriptionsGetById extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_get_by_id';
}
