<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get newsletter list subscription Beta OAuth Scope: newsletter_lists:read.
 *
 * Executes the official beehiiv API operation newsletterListSubscriptions_show.
 */
class BeehiivNewsletterListSubscriptionsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_newsletter_list_subscriptions_show';
}
