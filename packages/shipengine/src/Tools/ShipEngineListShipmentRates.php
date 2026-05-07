<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Shipment Rates.
 *
 * Maps to the official ShipEngine endpoint GET /v1/shipments/{shipment_id}/rates.
 */
class ShipEngineListShipmentRates extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_shipment_rates";
    protected const DESCRIPTION = "Get Shipment Rates\n\nOfficial ShipEngine endpoint: GET /v1/shipments/{shipment_id}/rates.";
    protected const PARAMETERS = [
        "shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Shipment ID",
        ],
        "created_at_start" => [
            "type" => "string",
            "required" => false,
            "description" => "Used to create a filter for when a resource was created (ex. A shipment that was created after a certain time)",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/shipments/{shipment_id}/rates";
    protected const PATH_PARAMS = [
        "shipment_id" => "shipment_id",
    ];
    protected const QUERY_PARAMS = [
        "created_at_start" => "created_at_start",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
