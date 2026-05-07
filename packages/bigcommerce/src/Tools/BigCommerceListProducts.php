<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List catalog products with BigCommerce v3 filters.
 */
class BigCommerceListProducts extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_products';

    protected string $toolDescription = 'List catalog products with BigCommerce v3 filters.';

    protected string $method = 'GET';

    protected string $path = '/v3/catalog/products';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of products to return.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for paginated endpoints.'],
        'include' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated related resources such as variants, images, or custom_fields.'],
        'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort field accepted by the BigCommerce endpoint.'],
        'direction' => ['type' => 'string', 'required' => false, 'description' => 'Sort direction accepted by the BigCommerce endpoint.'],
        'keyword' => ['type' => 'string', 'required' => false, 'description' => 'Product keyword or search term.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional documented BigCommerce query parameters to pass through.'],
    ];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = ['limit', 'page', 'include', 'sort', 'direction', 'keyword'];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}