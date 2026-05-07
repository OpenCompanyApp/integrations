<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Call any CircleCI API PUT endpoint path.
 */
class CircleCIApiPut extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_api_put';

    protected string $toolDescription = 'Call any CircleCI API PUT endpoint path.';

    protected string $method = 'PUT';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path to update.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'path',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
