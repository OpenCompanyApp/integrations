<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

/**
 * Create a fulfillment to mark an order shipped.
 */
class ShipStationFulfillmentsCreate extends AbstractShipStationTool
{
    protected const OPERATION = 'fulfillments_create';
}
