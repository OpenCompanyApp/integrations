<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get a CircleCI user by ID.
 */
class CircleCIGetUser extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_user';

    protected string $toolDescription = 'Get a CircleCI user by ID.';

    protected string $method = 'GET';

    protected string $path = '/v2/user/{user_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'user_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI user ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'user_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
