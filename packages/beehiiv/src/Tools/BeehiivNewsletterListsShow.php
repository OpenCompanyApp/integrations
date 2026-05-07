<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get newsletter list Beta OAuth Scope: newsletter_lists:read.
 *
 * Executes the official beehiiv API operation newsletterLists_show.
 */
class BeehiivNewsletterListsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_newsletter_lists_show';
}
