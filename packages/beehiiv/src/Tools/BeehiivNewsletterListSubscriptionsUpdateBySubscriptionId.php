<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update newsletter list subscription by subscription ID Beta OAuth Scope: newsletter_lists:write.
 *
 * Executes the official beehiiv API operation newsletterListSubscriptions_update_by_subscription_id.
 */
class BeehiivNewsletterListSubscriptionsUpdateBySubscriptionId extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_newsletter_list_subscriptions_update_by_subscription_id';
}
