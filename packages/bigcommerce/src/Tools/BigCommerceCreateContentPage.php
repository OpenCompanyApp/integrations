<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a BigCommerce Content Page.
 */
class BigCommerceCreateContentPage extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_content_page';

    protected string $toolDescription = 'Create a BigCommerce Content Page.';

    protected string $method = 'POST';

    protected string $path = '/v3/content/pages';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Content Page fields.',
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