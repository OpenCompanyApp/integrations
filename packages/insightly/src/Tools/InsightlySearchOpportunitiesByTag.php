<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly opportunities by tag.
 */
class InsightlySearchOpportunitiesByTag extends InsightlySearchContactsByTag
{
    protected string $toolName = 'insightly_search_opportunities_by_tag';
    protected string $toolDescription = 'Search Insightly opportunities by tag name.';
    protected string $path = '/v3.1/Opportunities/SearchByTag';
}
