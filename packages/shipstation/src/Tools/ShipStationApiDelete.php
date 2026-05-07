<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

/** Guarded raw DELETE request for relative ShipStation API paths. */
class ShipStationApiDelete extends AbstractShipStationRawTool
{
    protected const NAME = 'shipstation_api_delete';
    protected const DESCRIPTION = 'Call a safe relative ShipStation API DELETE path.';
    protected const METHOD = 'apiDelete';
}
