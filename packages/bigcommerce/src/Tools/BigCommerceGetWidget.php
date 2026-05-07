<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Widget.
 */
class BigCommerceGetWidget extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_widget';

    protected string $toolDescription = 'Get one BigCommerce Widget.';

    protected string $method = 'GET';

    protected string $path = '/v3/content/widgets/{widget_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'widget_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Widget ID.',
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
  0 => 'widget_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}