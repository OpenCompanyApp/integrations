<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a BigCommerce Widget.
 */
class BigCommerceCreateWidget extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_widget';

    protected string $toolDescription = 'Create a BigCommerce Widget.';

    protected string $method = 'POST';

    protected string $path = '/v3/content/widgets';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Widget fields.',
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