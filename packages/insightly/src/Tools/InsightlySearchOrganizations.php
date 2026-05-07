<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly organizations by field value or update timestamp.
 */
class InsightlySearchOrganizations extends InsightlySearchContacts
{
    protected string $toolName = 'insightly_search_organizations';
    protected string $toolDescription = 'Search Insightly organizations by field name/value or updated_after_utc.';
    protected string $path = '/v3.1/Organisations/Search';
}
