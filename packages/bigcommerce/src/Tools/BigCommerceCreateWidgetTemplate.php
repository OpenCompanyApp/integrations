<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a BigCommerce Widget Template.
 */
class BigCommerceCreateWidgetTemplate extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_widget_template';

    protected string $toolDescription = 'Create a BigCommerce Widget Template.';

    protected string $method = 'POST';

    protected string $path = '/v3/content/widget-templates';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Widget Template fields.',
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