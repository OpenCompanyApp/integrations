<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * List account-level offers when available.
 */
class GumroadListOffers extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_list_offers';

    protected string $toolDescription = 'List account-level offers when available.';

    protected string $method = 'GET';

    protected string $path = '/offers';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
