<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Webhook.
 */
class ShopifyCreateWebhook extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_webhook';

    protected string $toolDescription = 'Create a Shopify Webhook.';

    protected string $method = 'POST';

    protected string $path = '/webhooks.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Webhook request body, usually wrapped under its resource key.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}