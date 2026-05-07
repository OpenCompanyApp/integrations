<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

/** Guarded raw PATCH request for relative ShipStation API paths. */
class ShipStationApiPatch extends AbstractShipStationRawTool
{
    protected const NAME = 'shipstation_api_patch';
    protected const DESCRIPTION = 'Call a safe relative ShipStation API PATCH path.';
    protected const METHOD = 'apiPatch';
}
