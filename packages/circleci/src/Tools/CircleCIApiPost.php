<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Call any CircleCI API POST endpoint path.
 */
class CircleCIApiPost extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_api_post';

    protected string $toolDescription = 'Call any CircleCI API POST endpoint path.';

    protected string $method = 'POST';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path, such as /v2/project/gh/org/repo/pipeline.',
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
