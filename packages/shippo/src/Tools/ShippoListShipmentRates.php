<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve shipment rates.
 *
 * Maps to the official Shippo endpoint GET /shipments/{ShipmentId}/rates.
 */
class ShippoListShipmentRates extends AbstractShippoTool
{
    protected const NAME = "shippo_list_shipment_rates";
    protected const DESCRIPTION = "Retrieve shipment rates\n\nOfficial Shippo endpoint: GET /shipments/{ShipmentId}/rates.";
    protected const PARAMETERS = [
        "shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the shipment to update",
        ],
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "The page number you want to select",
        ],
        "results" => [
            "type" => "integer",
            "required" => false,
            "description" => "The number of results to return per page (max 100)",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/shipments/{ShipmentId}/rates";
    protected const PATH_PARAMS = [
        "ShipmentId" => "shipment_id",
    ];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "results" => "results",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
