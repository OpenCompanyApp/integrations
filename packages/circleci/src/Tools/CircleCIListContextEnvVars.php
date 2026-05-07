<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List environment variables in a context without values.
 */
class CircleCIListContextEnvVars extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_context_env_vars';

    protected string $toolDescription = 'List environment variables in a context without values.';

    protected string $method = 'GET';

    protected string $path = '/v2/context/{context_id}/environment-variable';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'context_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Context ID.',
    ],
    'page_token' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Pagination token from the previous response.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'context_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'page_token' => 'page-token',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
