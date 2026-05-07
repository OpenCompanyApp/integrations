<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a pickup.
 *
 * Maps to the official Shippo endpoint POST /pickups.
 */
class ShippoCreatePickup extends AbstractShippoTool
{
    protected const NAME = "shippo_create_pickup";
    protected const DESCRIPTION = "Create a pickup\n\nOfficial Shippo endpoint: POST /pickups.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Shippos pickups endpoint allows you to schedule pickups with USPS and DHL Express for eligible shipments that you have already created.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/pickups";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
