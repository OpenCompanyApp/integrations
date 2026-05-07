<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update newsletter list subscription Beta OAuth Scope: newsletter_lists:write.
 *
 * Executes the official beehiiv API operation newsletterListSubscriptions_update.
 */
class BeehiivNewsletterListSubscriptionsUpdate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_newsletter_list_subscriptions_update';
}
