<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List newsletter list subscriptions Beta OAuth Scope: newsletter_lists:read.
 *
 * Executes the official beehiiv API operation newsletterListSubscriptions_index.
 */
class BeehiivNewsletterListSubscriptionsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_newsletter_list_subscriptions_index';
}
