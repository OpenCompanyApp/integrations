<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get the currently authenticated Bugsnag user.
 */
class BugsnagGetCurrentUser extends AbstractBugsnagTool
{
    protected array $parameters = array (
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/user';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_current_user';

    protected string $toolDescription = 'Get the currently authenticated Bugsnag user.';
}
