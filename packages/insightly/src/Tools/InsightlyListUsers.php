<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly users.
 */
class InsightlyListUsers extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_users';
    protected string $toolDescription = 'List Insightly users.';
    protected string $path = '/v3.1/Users';
    protected array $queryParams = ['brief', 'skip', 'top', 'count_total'];
    protected array $parameters = [
        'brief' => ['type' => 'boolean', 'description' => 'Return only top-level fields.'],
        'skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        'top' => ['type' => 'integer', 'description' => 'Maximum number of records to return.'],
        'count_total' => ['type' => 'boolean', 'description' => 'Ask Insightly to include total count metadata.'],
    ];
}
