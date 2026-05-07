<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new shipment.
 *
 * Maps to the official Shippo endpoint POST /shipments.
 */
class ShippoCreateShipment extends AbstractShippoTool
{
    protected const NAME = "shippo_create_shipment";
    protected const DESCRIPTION = "Create a new shipment\n\nOfficial Shippo endpoint: POST /shipments.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Shipment details and contact info.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/shipments";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
