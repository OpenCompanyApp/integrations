<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly projects by field value or update timestamp.
 */
class InsightlySearchProjects extends InsightlySearchContacts
{
    protected string $toolName = 'insightly_search_projects';
    protected string $toolDescription = 'Search Insightly projects by field name/value or updated_after_utc.';
    protected string $path = '/v3.1/Projects/Search';
}
