<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly opportunities by field value or update timestamp.
 */
class InsightlySearchOpportunities extends InsightlySearchContacts
{
    protected string $toolName = 'insightly_search_opportunities';
    protected string $toolDescription = 'Search Insightly opportunities by field name/value or updated_after_utc.';
    protected string $path = '/v3.1/Opportunities/Search';
}
