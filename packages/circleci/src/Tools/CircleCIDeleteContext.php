<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Delete a context and its environment variables.
 */
class CircleCIDeleteContext extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_delete_context';

    protected string $toolDescription = 'Delete a context and its environment variables.';

    protected string $method = 'DELETE';

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
