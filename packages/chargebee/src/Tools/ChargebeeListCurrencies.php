<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * List Chargebee currencies.
 */
class ChargebeeListCurrencies extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
    ];

    protected array $required = [];

    protected array $queryParams = ['limit', 'offset'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/currencies';

    protected string $toolName = 'chargebee_list_currencies';

    protected string $toolDescription = 'List Chargebee currencies.';
}
