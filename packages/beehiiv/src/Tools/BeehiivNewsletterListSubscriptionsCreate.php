<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Create newsletter list subscription Beta OAuth Scope: newsletter_lists:write.
 *
 * Executes the official beehiiv API operation newsletterListSubscriptions_create.
 */
class BeehiivNewsletterListSubscriptionsCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_newsletter_list_subscriptions_create';
}
