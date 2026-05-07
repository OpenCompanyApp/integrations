<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Webhook.
 */
class ShopifyUpdateWebhook extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_webhook';

    protected string $toolDescription = 'Update a Shopify Webhook.';

    protected string $method = 'PUT';

    protected string $path = '/webhooks/{webhook_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'webhook_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Webhook ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Webhook update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'webhook_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}