<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a BigCommerce Channel.
 */
class BigCommerceCreateChannel extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_channel';

    protected string $toolDescription = 'Create a BigCommerce Channel.';

    protected string $method = 'POST';

    protected string $path = '/v3/channels';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Channel fields.',
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