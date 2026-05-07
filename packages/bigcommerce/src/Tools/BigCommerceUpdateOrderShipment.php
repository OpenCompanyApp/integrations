<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a shipment for an order.
 */
class BigCommerceUpdateOrderShipment extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_order_shipment';

    protected string $toolDescription = 'Update a shipment for an order.';

    protected string $method = 'PUT';

    protected string $path = '/v2/orders/{order_id}/shipments/{shipment_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce order ID.',
  ),
  'shipment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Shipment ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Shipment fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'order_id',
  1 => 'shipment_id',
  2 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}