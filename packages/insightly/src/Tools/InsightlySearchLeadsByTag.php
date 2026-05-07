<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly leads by tag.
 */
class InsightlySearchLeadsByTag extends InsightlySearchContactsByTag
{
    protected string $toolName = 'insightly_search_leads_by_tag';
    protected string $toolDescription = 'Search Insightly leads by tag name.';
    protected string $path = '/v3.1/Leads/SearchByTag';
}
