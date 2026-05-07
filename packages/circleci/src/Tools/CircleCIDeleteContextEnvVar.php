<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Delete a context environment variable.
 */
class CircleCIDeleteContextEnvVar extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_delete_context_env_var';

    protected string $toolDescription = 'Delete a context environment variable.';

    protected string $method = 'DELETE';

    protected string $path = '/v2/context/{context_id}/environment-variable/{env_var_name}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'context_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Context ID.',
    ],
    'env_var_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Environment variable name.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'context_id',
    'env_var_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
