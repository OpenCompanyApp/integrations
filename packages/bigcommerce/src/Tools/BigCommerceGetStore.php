<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get store information.
 */
class BigCommerceGetStore extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_store';

    protected string $toolDescription = 'Get store information.';

    protected string $method = 'GET';

    protected string $path = '/v2/store';

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