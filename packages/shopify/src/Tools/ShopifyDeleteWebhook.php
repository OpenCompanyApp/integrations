<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Webhook.
 */
class ShopifyDeleteWebhook extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_webhook';

    protected string $toolDescription = 'Delete a Shopify Webhook.';

    protected string $method = 'DELETE';

    protected string $path = '/webhooks/{webhook_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'webhook_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Webhook ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'webhook_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}