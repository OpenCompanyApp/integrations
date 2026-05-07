<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Add or update a context environment variable.
 */
class CircleCIUpsertContextEnvVar extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_upsert_context_env_var';

    protected string $toolDescription = 'Add or update a context environment variable.';

    protected string $method = 'PUT';

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
    'value' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Secret value.',
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
    'env_var_name',
    'value',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'value',
];
}
