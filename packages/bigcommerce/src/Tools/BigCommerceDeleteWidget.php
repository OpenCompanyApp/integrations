<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Widget.
 */
class BigCommerceDeleteWidget extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_widget';

    protected string $toolDescription = 'Delete a BigCommerce Widget.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/content/widgets/{widget_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'widget_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Widget ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'widget_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}