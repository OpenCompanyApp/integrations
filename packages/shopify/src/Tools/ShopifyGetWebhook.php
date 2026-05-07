<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Webhook.
 */
class ShopifyGetWebhook extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_webhook';

    protected string $toolDescription = 'Get one Shopify Webhook.';

    protected string $method = 'GET';

    protected string $path = '/webhooks/{webhook_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'webhook_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Webhook ID.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated fields to return.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'webhook_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}