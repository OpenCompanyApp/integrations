<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly organizations by tag.
 */
class InsightlySearchOrganizationsByTag extends InsightlySearchContactsByTag
{
    protected string $toolName = 'insightly_search_organizations_by_tag';
    protected string $toolDescription = 'Search Insightly organizations by tag name.';
    protected string $path = '/v3.1/Organisations/SearchByTag';
}
