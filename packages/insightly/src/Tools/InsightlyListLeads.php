<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly leads.
 */
class InsightlyListLeads extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_leads';
    protected string $toolDescription = 'List leads from Insightly CRM.';
    protected string $path = '/v3.1/Leads';
    protected array $queryParams = ['top', 'skip', 'brief', 'count_total'];
    protected array $parameters = [
        'top' => ['type' => 'integer', 'description' => 'Maximum number of leads to return.'],
        'skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        'brief' => ['type' => 'boolean', 'description' => 'Return brief records when supported.'],
        'count_total' => ['type' => 'boolean', 'description' => 'Ask Insightly to include total count metadata.'],
    ];
}
