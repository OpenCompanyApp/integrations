<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get subscription update OAuth Scope: subscriptions:read.
 *
 * Executes the official beehiiv API operation bulkSubscriptionUpdates_show.
 */
class BeehiivBulkSubscriptionUpdatesShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_bulk_subscription_updates_show';
}
