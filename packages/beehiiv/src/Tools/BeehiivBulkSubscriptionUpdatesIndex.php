<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List subscription updates OAuth Scope: subscriptions:read.
 *
 * Executes the official beehiiv API operation bulkSubscriptionUpdates_index.
 */
class BeehiivBulkSubscriptionUpdatesIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_bulk_subscription_updates_index';
}
