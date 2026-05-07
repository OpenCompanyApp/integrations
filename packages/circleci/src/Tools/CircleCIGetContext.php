<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get a context by ID.
 */
class CircleCIGetContext extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_context';

    protected string $toolDescription = 'Get a context by ID.';

    protected string $method = 'GET';

    protected string $path = '/v2/context/{context_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'context_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Context ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'context_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
