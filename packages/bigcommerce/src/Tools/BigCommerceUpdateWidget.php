<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Widget.
 */
class BigCommerceUpdateWidget extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_widget';

    protected string $toolDescription = 'Update a BigCommerce Widget.';

    protected string $method = 'PUT';

    protected string $path = '/v3/content/widgets/{widget_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'widget_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Widget ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Widget fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'widget_id',
  1 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}