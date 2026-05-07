<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a shipment for an order.
 */
class BigCommerceDeleteOrderShipment extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_order_shipment';

    protected string $toolDescription = 'Delete a shipment for an order.';

    protected string $method = 'DELETE';

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
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'order_id',
  1 => 'shipment_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}