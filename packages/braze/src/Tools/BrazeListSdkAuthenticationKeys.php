<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List SDK authentication keys.
 */
class BrazeListSdkAuthenticationKeys extends AbstractBrazeTool
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

    protected string $path = '/app_group/sdk_authentication/keys';

    protected string $toolName = 'braze_list_sdk_authentication_keys';

    protected string $toolDescription = 'List SDK authentication keys.';
}