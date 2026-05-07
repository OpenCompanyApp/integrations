<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

/** Guarded raw GET request for relative ShipStation API paths. */
class ShipStationApiGet extends AbstractShipStationRawTool
{
    protected const NAME = 'shipstation_api_get';
    protected const DESCRIPTION = 'Call a safe relative ShipStation API GET path.';
    protected const METHOD = 'apiGet';
}
