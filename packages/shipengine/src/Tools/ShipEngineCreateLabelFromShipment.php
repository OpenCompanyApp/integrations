<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Purchase Label with Shipment ID.
 *
 * Maps to the official ShipEngine endpoint POST /v1/labels/shipment/{shipment_id}.
 */
class ShipEngineCreateLabelFromShipment extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_label_from_shipment";
    protected const DESCRIPTION = "Purchase Label with Shipment ID\n\nOfficial ShipEngine endpoint: POST /v1/labels/shipment/{shipment_id}.";
    protected const PARAMETERS = [
        "shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Shipment ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Purchase Label with Shipment ID.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/labels/shipment/{shipment_id}";
    protected const PATH_PARAMS = [
        "shipment_id" => "shipment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
