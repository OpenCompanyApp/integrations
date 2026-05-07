<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a BigCommerce Webhook.
 */
class BigCommerceCreateWebhook extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_webhook';

    protected string $toolDescription = 'Create a BigCommerce Webhook.';

    protected string $method = 'POST';

    protected string $path = '/v3/hooks';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Webhook fields.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}