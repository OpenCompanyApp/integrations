<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List contexts for an owner.
 */
class CircleCIListContexts extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_contexts';

    protected string $toolDescription = 'List contexts for an owner.';

    protected string $method = 'GET';

    protected string $path = '/v2/context';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'owner_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Owner organization ID.',
    ],
    'owner_slug' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Organization slug, such as gh/org or circleci/org-id.',
    ],
    'owner_type' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Owner type: organization or account.',
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
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'owner_id' => 'owner-id',
    'owner_slug' => 'owner-slug',
    'owner_type' => 'owner-type',
    'page_token' => 'page-token',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
