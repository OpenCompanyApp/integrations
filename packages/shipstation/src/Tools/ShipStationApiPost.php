<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

/** Guarded raw POST request for relative ShipStation API paths. */
class ShipStationApiPost extends AbstractShipStationRawTool
{
    protected const NAME = 'shipstation_api_post';
    protected const DESCRIPTION = 'Call a safe relative ShipStation API POST path.';
    protected const METHOD = 'apiPost';
}
