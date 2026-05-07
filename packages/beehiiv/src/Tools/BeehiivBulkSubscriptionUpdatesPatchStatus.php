<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update subscriptions' status OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation bulkSubscriptionUpdates_patch-status.
 */
class BeehiivBulkSubscriptionUpdatesPatchStatus extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_bulk_subscription_updates_patch_status';
}
