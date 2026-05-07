<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * List or filter Close opportunities.
 */
class CloseListOpportunities extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_list_opportunities';

    protected string $toolDescription = 'List or filter Close opportunities by lead, status, user, value, close date, and pagination fields.';

    protected string $path = '/opportunity/';

    /** @var list<string> */
    protected array $queryParams = ['lead_id', 'status_id', 'user_id', 'query', '_limit', '_skip', '_order_by'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'lead_id' => ['type' => 'string', 'description' => 'Filter opportunities by Close lead ID.'],
        'status_id' => ['type' => 'string', 'description' => 'Filter opportunities by opportunity status ID.'],
        'user_id' => ['type' => 'string', 'description' => 'Filter opportunities by assigned user ID.'],
        'query' => ['type' => 'string', 'description' => 'Close search query for opportunities.'],
        '_limit' => ['type' => 'integer', 'description' => 'Maximum number of opportunities to return.'],
        '_skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        '_order_by' => ['type' => 'string', 'description' => 'Sort order supported by Close, for example date_created.'],
    ];
}
