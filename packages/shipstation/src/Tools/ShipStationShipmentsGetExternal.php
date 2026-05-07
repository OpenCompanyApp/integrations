<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

/**
 * Retrieve a shipment by external shipment ID.
 */
class ShipStationShipmentsGetExternal extends AbstractShipStationTool
{
    protected const OPERATION = 'shipments_get_external';
}
