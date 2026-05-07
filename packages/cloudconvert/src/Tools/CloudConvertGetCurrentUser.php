<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Get the authenticated CloudConvert user profile and remaining credits.
 */
class CloudConvertGetCurrentUser extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_get_current_user';

    protected string $toolDescription = 'Get the authenticated CloudConvert user profile and remaining credits.';

    protected string $method = 'GET';

    protected string $path = '/users/me';

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
