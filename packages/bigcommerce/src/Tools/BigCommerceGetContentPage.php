<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Content Page.
 */
class BigCommerceGetContentPage extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_content_page';

    protected string $toolDescription = 'Get one BigCommerce Content Page.';

    protected string $method = 'GET';

    protected string $path = '/v3/content/pages/{page_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'page_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Content Page ID.',
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
  0 => 'page_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}