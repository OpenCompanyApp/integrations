<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Parse shipping info.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/shipments/recognize.
 */
class ShipEngineParseShipment extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_parse_shipment";
    protected const DESCRIPTION = "Parse shipping info\n\nOfficial ShipEngine endpoint: PUT /v1/shipments/recognize.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "The only required field is text, which is the text to be parsed. You can optionally also provide a shipment containing any already-known values. For example, you probably already know the ship_from address, and you may also already know what carrier and service you want to use.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/shipments/recognize";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
