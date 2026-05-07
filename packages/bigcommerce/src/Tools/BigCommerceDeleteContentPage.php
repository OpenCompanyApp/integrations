<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Content Page.
 */
class BigCommerceDeleteContentPage extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_content_page';

    protected string $toolDescription = 'Delete a BigCommerce Content Page.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/content/pages/{page_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'page_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Content Page ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'page_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}