<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Bulk create subscription OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation bulkSubscriptions_create.
 */
class BeehiivBulkSubscriptionsCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_bulk_subscriptions_create';
}
