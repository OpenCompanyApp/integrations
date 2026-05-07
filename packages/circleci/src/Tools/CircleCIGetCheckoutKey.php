<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get a project checkout key by fingerprint.
 */
class CircleCIGetCheckoutKey extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_checkout_key';

    protected string $toolDescription = 'Get a project checkout key by fingerprint.';

    protected string $method = 'GET';

    protected string $path = '/v2/project/{project_slug}/checkout-key/{fingerprint}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
    ],
    'fingerprint' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Checkout key fingerprint.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'project_slug',
    'fingerprint',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
