<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List products for a BigCommerce order.
 */
class BigCommerceListOrderProducts extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_order_products';

    protected string $toolDescription = 'List products for a BigCommerce order.';

    protected string $method = 'GET';

    protected string $path = '/v2/orders/{order_id}/products';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'order_id' => ['type' => 'string', 'required' => true, 'description' => 'BigCommerce order ID.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of records to return.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for paginated endpoints.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional documented BigCommerce query parameters to pass through.'],
    ];

    /** @var list<string> */
    protected array $required = ['order_id'];

    /** @var array<int|string, string> */
    protected array $queryParams = ['limit', 'page'];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}