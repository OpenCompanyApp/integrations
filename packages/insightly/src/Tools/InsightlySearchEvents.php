<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly events by field value or update timestamp.
 */
class InsightlySearchEvents extends InsightlySearchContacts
{
    protected string $toolName = 'insightly_search_events';
    protected string $toolDescription = 'Search Insightly events by field name/value or updated_after_utc.';
    protected string $path = '/v3.1/Events/Search';
}
