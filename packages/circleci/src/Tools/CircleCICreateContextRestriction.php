<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Create a context restriction.
 */
class CircleCICreateContextRestriction extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_create_context_restriction';

    protected string $toolDescription = 'Create a context restriction.';

    protected string $method = 'POST';

    protected string $path = '/v2/context/{context_id}/restriction';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'context_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Context ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
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
    'payload',
];
}
