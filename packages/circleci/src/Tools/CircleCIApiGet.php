<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Call any CircleCI API GET endpoint path.
 */
class CircleCIApiGet extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_api_get';

    protected string $toolDescription = 'Call any CircleCI API GET endpoint path.';

    protected string $method = 'GET';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path, such as /v2/pipeline.',
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
];
}
