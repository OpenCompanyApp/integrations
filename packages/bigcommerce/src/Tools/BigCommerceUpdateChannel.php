<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Channel.
 */
class BigCommerceUpdateChannel extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_channel';

    protected string $toolDescription = 'Update a BigCommerce Channel.';

    protected string $method = 'PUT';

    protected string $path = '/v3/channels/{channel_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'channel_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Channel ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Channel fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'channel_id',
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