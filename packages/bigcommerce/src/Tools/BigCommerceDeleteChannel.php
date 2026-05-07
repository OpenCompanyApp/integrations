<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Channel.
 */
class BigCommerceDeleteChannel extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_channel';

    protected string $toolDescription = 'Delete a BigCommerce Channel.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/channels/{channel_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'channel_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Channel ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'channel_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}