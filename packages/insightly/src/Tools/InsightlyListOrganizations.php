<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly organizations.
 */
class InsightlyListOrganizations extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_organizations';
    protected string $toolDescription = 'List organizations from Insightly CRM.';
    protected string $path = '/v3.1/Organisations';
    protected array $queryParams = ['top', 'skip', 'brief', 'count_total'];
    protected array $parameters = [
        'top' => ['type' => 'integer', 'description' => 'Maximum number of organizations to return.'],
        'skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        'brief' => ['type' => 'boolean', 'description' => 'Return brief records when supported.'],
        'count_total' => ['type' => 'boolean', 'description' => 'Ask Insightly to include total count metadata.'],
    ];
}
