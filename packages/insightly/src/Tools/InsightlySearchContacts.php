<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly contacts by field value or update timestamp.
 */
class InsightlySearchContacts extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_search_contacts';
    protected string $toolDescription = 'Search Insightly contacts by field name/value or updated_after_utc.';
    protected string $path = '/v3.1/Contacts/Search';
    protected array $queryParams = ['field_name', 'field_value', 'updated_after_utc', 'brief', 'skip', 'top', 'count_total'];
    protected array $parameters = [
        'field_name' => ['type' => 'string', 'description' => 'Insightly field name to search.'],
        'field_value' => ['type' => 'string', 'description' => 'Field value to match.'],
        'updated_after_utc' => ['type' => 'string', 'description' => 'Return records updated after this UTC timestamp.'],
        'brief' => ['type' => 'boolean', 'description' => 'Return only top-level fields.'],
        'skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        'top' => ['type' => 'integer', 'description' => 'Maximum number of records to return.'],
        'count_total' => ['type' => 'boolean', 'description' => 'Ask Insightly to include total count metadata.'],
    ];
}
