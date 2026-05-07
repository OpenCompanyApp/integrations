<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update subscriptions' status OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation bulkSubscriptionUpdates_put-status.
 */
class BeehiivBulkSubscriptionUpdatesPutStatus extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_bulk_subscription_updates_put_status';
}
