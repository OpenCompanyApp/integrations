<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List subscriptions OAuth Scope: subscriptions:read.
 *
 * Executes the official beehiiv API operation subscriptions_index.
 */
class BeehiivSubscriptionsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_index';
}
