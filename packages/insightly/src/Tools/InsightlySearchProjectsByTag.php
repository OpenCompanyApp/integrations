<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly projects by tag.
 */
class InsightlySearchProjectsByTag extends InsightlySearchContactsByTag
{
    protected string $toolName = 'insightly_search_projects_by_tag';
    protected string $toolDescription = 'Search Insightly projects by tag name.';
    protected string $path = '/v3.1/Projects/SearchByTag';
}
