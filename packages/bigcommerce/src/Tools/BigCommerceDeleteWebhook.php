<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Webhook.
 */
class BigCommerceDeleteWebhook extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_webhook';

    protected string $toolDescription = 'Delete a BigCommerce Webhook.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/hooks/{hook_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'hook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Webhook ID.',
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