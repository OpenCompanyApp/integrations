<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * List Chargebee attached items with filters and pagination.
 */
class ChargebeeListAttachedItems extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
            'id[is]' => ['type' => 'string', 'description' => 'Filter by exact resource ID.'],
            'status[is]' => ['type' => 'string', 'description' => 'Filter by exact status.'],
            'customer_id[is]' => ['type' => 'string', 'description' => 'Filter by exact customer ID.'],
            'subscription_id[is]' => ['type' => 'string', 'description' => 'Filter by exact subscription ID.'],
            'updated_at[after]' => ['type' => 'integer', 'description' => 'Filter records updated after a Unix timestamp.'],
            'created_at[after]' => ['type' => 'integer', 'description' => 'Filter records created after a Unix timestamp.'],
    ];

    protected array $required = [];

    protected array $queryParams = ['limit', 'offset', 'id[is]', 'status[is]', 'customer_id[is]', 'subscription_id[is]', 'updated_at[after]', 'created_at[after]'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/attached_items';

    protected string $toolName = 'chargebee_list_attached_items';

    protected string $toolDescription = 'List Chargebee attached items with filters and pagination.';
}
