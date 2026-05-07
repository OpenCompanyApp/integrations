<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly leads by field value or update timestamp.
 */
class InsightlySearchLeads extends InsightlySearchContacts
{
    protected string $toolName = 'insightly_search_leads';
    protected string $toolDescription = 'Search Insightly leads by field name/value or updated_after_utc.';
    protected string $path = '/v3.1/Leads/Search';
}
