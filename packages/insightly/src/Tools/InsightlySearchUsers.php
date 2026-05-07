<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly users by field value.
 */
class InsightlySearchUsers extends InsightlySearchContacts
{
    protected string $toolName = 'insightly_search_users';
    protected string $toolDescription = 'Search Insightly users by field name/value.';
    protected string $path = '/v3.1/Users/Search';
}
