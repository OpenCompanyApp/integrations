<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a shipment for an order.
 */
class BigCommerceCreateOrderShipment extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_order_shipment';

    protected string $toolDescription = 'Create a shipment for an order.';

    protected string $method = 'POST';

    protected string $path = '/v2/orders/{order_id}/shipments';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce order ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Shipment fields.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'order_id',
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