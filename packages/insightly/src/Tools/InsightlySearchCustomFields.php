<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly custom fields for an object type.
 */
class InsightlySearchCustomFields extends InsightlySearchContacts
{
    protected string $toolName = 'insightly_search_custom_fields';
    protected string $toolDescription = 'Search Insightly custom fields for an object type.';
    protected string $path = '/v3.1/CustomFields/{objectName}/Search';
    protected array $required = ['objectName'];
    protected array $parameters = [
        'objectName' => ['type' => 'string', 'required' => true, 'description' => 'Insightly object name, for example Contacts or Organisations.'],
        'field_name' => ['type' => 'string', 'description' => 'Custom field metadata field name to search.'],
        'field_value' => ['type' => 'string', 'description' => 'Field value to match.'],
        'updated_after_utc' => ['type' => 'string', 'description' => 'Return records updated after this UTC timestamp.'],
        'brief' => ['type' => 'boolean', 'description' => 'Return only top-level fields.'],
        'skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        'top' => ['type' => 'integer', 'description' => 'Maximum number of records to return.'],
        'count_total' => ['type' => 'boolean', 'description' => 'Ask Insightly to include total count metadata.'],
    ];
}
