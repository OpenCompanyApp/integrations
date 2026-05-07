<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Shipment By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/shipments/{shipment_id}.
 */
class ShipEngineGetShipmentById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_shipment_by_id";
    protected const DESCRIPTION = "Get Shipment By ID\n\nOfficial ShipEngine endpoint: GET /v1/shipments/{shipment_id}.";
    protected const PARAMETERS = [
        "shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Shipment ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/shipments/{shipment_id}";
    protected const PATH_PARAMS = [
        "shipment_id" => "shipment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
