<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List VCS collaborations for the authenticated user.
 */
class CircleCIListCollaborations extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_collaborations';

    protected string $toolDescription = 'List VCS collaborations for the authenticated user.';

    protected string $method = 'GET';

    protected string $path = '/v2/me/collaborations';

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
