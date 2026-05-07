<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List SMS campaigns.
 */
class BrevoListSmsCampaigns extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_sms_campaigns';

    protected string $toolDescription = 'List SMS campaigns.';

    protected string $method = 'GET';

    protected string $path = '/smsCampaigns';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Campaign status filter.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum records to return.',
    ],
    'offset' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of records to skip.',
    ],
    'sort' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Sort order when supported.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'status',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
