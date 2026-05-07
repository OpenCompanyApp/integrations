<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Compatibility alias that returns storefront status.
 */
class BigCommerceGetCurrentUser extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_current_user';

    protected string $toolDescription = 'Compatibility alias that returns storefront status.';

    protected string $method = 'GET';

    protected string $path = '/v3/storefront/status';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
);

    /** @var list<string> */
    protected array $required = array (
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}