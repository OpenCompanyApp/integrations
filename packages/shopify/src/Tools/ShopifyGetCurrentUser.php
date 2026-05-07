<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Compatibility alias for shop metadata.
 */
class ShopifyGetCurrentUser extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_current_user';

    protected string $toolDescription = 'Compatibility alias for shop metadata.';

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