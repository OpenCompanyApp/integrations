<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update subscription by email OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation subscriptions_update-by-email.
 */
class BeehiivSubscriptionsUpdateByEmail extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_update_by_email';
}
