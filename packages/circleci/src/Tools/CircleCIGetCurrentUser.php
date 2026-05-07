<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get the authenticated CircleCI user profile.
 */
class CircleCIGetCurrentUser extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_current_user';

    protected string $toolDescription = 'Get the authenticated CircleCI user profile.';

    protected string $method = 'GET';

    protected string $path = '/v2/user';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
