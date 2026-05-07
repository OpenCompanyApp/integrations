<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * List Bugsnag organizations for the authenticated user.
 */
class BugsnagListOrganizations extends AbstractBugsnagTool
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

    protected string $path = '/user/organizations';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_list_organizations';

    protected string $toolDescription = 'List Bugsnag organizations for the authenticated user.';
}
