<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Widget Template.
 */
class BigCommerceDeleteWidgetTemplate extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_widget_template';

    protected string $toolDescription = 'Delete a BigCommerce Widget Template.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/content/widget-templates/{template_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'template_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Widget Template ID.',
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