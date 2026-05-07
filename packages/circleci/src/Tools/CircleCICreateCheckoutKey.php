<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Create a checkout key for a project.
 */
class CircleCICreateCheckoutKey extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_create_checkout_key';

    protected string $toolDescription = 'Create a checkout key for a project.';

    protected string $method = 'POST';

    protected string $path = '/v2/project/{project_slug}/checkout-key';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
    ],
    'type' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Checkout key type, such as deploy-key or github-user-key.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'project_slug',
    'type',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'type',
];
}
