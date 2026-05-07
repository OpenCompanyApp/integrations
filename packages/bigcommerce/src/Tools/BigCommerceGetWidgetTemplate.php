<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Widget Template.
 */
class BigCommerceGetWidgetTemplate extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_widget_template';

    protected string $toolDescription = 'Get one BigCommerce Widget Template.';

    protected string $method = 'GET';

    protected string $path = '/v3/content/widget-templates/{template_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'template_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Widget Template ID.',
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
  0 => 'template_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}