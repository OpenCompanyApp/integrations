<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update subscriptions OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation bulkSubscriptionUpdates_patch.
 */
class BeehiivBulkSubscriptionUpdatesPatch extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_bulk_subscription_updates_patch';
}
