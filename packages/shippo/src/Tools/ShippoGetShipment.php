<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a shipment.
 *
 * Maps to the official Shippo endpoint GET /shipments/{ShipmentId}.
 */
class ShippoGetShipment extends AbstractShippoTool
{
    protected const NAME = "shippo_get_shipment";
    protected const DESCRIPTION = "Retrieve a shipment\n\nOfficial Shippo endpoint: GET /shipments/{ShipmentId}.";
    protected const PARAMETERS = [
        "shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the shipment to update",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/shipments/{ShipmentId}";
    protected const PATH_PARAMS = [
        "ShipmentId" => "shipment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
