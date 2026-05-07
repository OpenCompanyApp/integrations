<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

/** Guarded raw PUT request for relative ShipStation API paths. */
class ShipStationApiPut extends AbstractShipStationRawTool
{
    protected const NAME = 'shipstation_api_put';
    protected const DESCRIPTION = 'Call a safe relative ShipStation API PUT path.';
    protected const METHOD = 'apiPut';
}
