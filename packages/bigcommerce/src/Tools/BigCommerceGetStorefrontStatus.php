<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get storefront status and verify API access.
 */
class BigCommerceGetStorefrontStatus extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_storefront_status';

    protected string $toolDescription = 'Get storefront status and verify API access.';

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