<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get subscription by email OAuth Scope: subscriptions:read.
 *
 * Executes the official beehiiv API operation subscriptions_get-by-email.
 */
class BeehiivSubscriptionsGetByEmail extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_get_by_email';
}
