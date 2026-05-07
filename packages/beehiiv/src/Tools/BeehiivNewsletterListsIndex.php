<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List newsletter lists Beta OAuth Scope: newsletter_lists:read.
 *
 * Executes the official beehiiv API operation newsletterLists_index.
 */
class BeehiivNewsletterListsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_newsletter_lists_index';
}
