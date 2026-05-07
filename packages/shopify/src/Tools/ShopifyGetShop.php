<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get shop metadata and verify Admin REST access.
 */
class ShopifyGetShop extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_shop';

    protected string $toolDescription = 'Get shop metadata and verify Admin REST access.';

    protected string $method = 'GET';

    protected string $path = '/shop.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}