<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update Shipment By ID.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/shipments/{shipment_id}.
 */
class ShipEngineUpdateShipment extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_update_shipment";
    protected const DESCRIPTION = "Update Shipment By ID\n\nOfficial ShipEngine endpoint: PUT /v1/shipments/{shipment_id}.";
    protected const PARAMETERS = [
        "shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Shipment ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Update Shipment By ID.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/shipments/{shipment_id}";
    protected const PATH_PARAMS = [
        "shipment_id" => "shipment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
