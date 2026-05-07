<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Webhook.
 */
class BigCommerceGetWebhook extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_webhook';

    protected string $toolDescription = 'Get one BigCommerce Webhook.';

    protected string $method = 'GET';

    protected string $path = '/v3/hooks/{hook_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'hook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Webhook ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented query parameters.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'hook_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}