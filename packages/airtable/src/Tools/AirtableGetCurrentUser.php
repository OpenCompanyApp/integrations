<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Get the currently authenticated Airtable user.
 */
class AirtableGetCurrentUser extends AbstractAirtableTool
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

    protected string $path = '/whoami';

    protected string $toolName = 'airtable_get_current_user';

    protected string $toolDescription = 'Get the currently authenticated Airtable user.';
}
