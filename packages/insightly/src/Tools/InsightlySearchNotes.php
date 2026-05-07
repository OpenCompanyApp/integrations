<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly notes by field value or update timestamp.
 */
class InsightlySearchNotes extends InsightlySearchContacts
{
    protected string $toolName = 'insightly_search_notes';
    protected string $toolDescription = 'Search Insightly notes by field name/value or updated_after_utc.';
    protected string $path = '/v3.1/Notes/Search';
}
