<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List pipelines visible to the authenticated user or organization.
 */
class CircleCIListPipelines extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_pipelines';

    protected string $toolDescription = 'List pipelines visible to the authenticated user or organization.';

    protected string $method = 'GET';

    protected string $path = '/v2/pipeline';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'org_slug' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Organization slug, such as gh/org or circleci/org-id.',
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
    'org_slug' => 'org-slug',
    'page_token' => 'page-token',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
