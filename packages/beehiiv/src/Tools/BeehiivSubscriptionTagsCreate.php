<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Add subscription tag OAuth Scope: subscriptions:write.
 *
 * Executes the official beehiiv API operation subscriptionTags_create.
 */
class BeehiivSubscriptionTagsCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscription_tags_create';
}
