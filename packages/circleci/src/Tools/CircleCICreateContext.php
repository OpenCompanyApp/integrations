<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Create a CircleCI context.
 */
class CircleCICreateContext extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_create_context';

    protected string $toolDescription = 'Create a CircleCI context.';

    protected string $method = 'POST';

    protected string $path = '/v2/context';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Context name.',
    ],
    'owner' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Owner object with id and type.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'name',
    'owner',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'name',
    'owner',
];
}
