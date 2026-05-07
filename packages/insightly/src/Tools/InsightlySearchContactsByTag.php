<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Search Insightly contacts by tag.
 */
class InsightlySearchContactsByTag extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_search_contacts_by_tag';
    protected string $toolDescription = 'Search Insightly contacts by tag name.';
    protected string $path = '/v3.1/Contacts/SearchByTag';
    protected array $required = ['tagName'];
    protected array $queryParams = ['tagName', 'brief', 'skip', 'top', 'count_total'];
    protected array $parameters = [
        'tagName' => ['type' => 'string', 'required' => true, 'description' => 'Tag name to filter on.'],
        'brief' => ['type' => 'boolean', 'description' => 'Return only top-level fields.'],
        'skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        'top' => ['type' => 'integer', 'description' => 'Maximum number of records to return.'],
        'count_total' => ['type' => 'boolean', 'description' => 'Ask Insightly to include total count metadata.'],
    ];
}
