<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Content Page.
 */
class BigCommerceUpdateContentPage extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_content_page';

    protected string $toolDescription = 'Update a BigCommerce Content Page.';

    protected string $method = 'PUT';

    protected string $path = '/v3/content/pages/{page_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'page_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Content Page ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Content Page fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'page_id',
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