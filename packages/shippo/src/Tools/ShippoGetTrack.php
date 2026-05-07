<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Get a tracking status.
 *
 * Maps to the official Shippo endpoint GET /tracks/{Carrier}/{TrackingNumber}.
 */
class ShippoGetTrack extends AbstractShippoTool
{
    protected const NAME = "shippo_get_track";
    protected const DESCRIPTION = "Get a tracking status\n\nOfficial Shippo endpoint: GET /tracks/{Carrier}/{TrackingNumber}.";
    protected const PARAMETERS = [
        "tracking_number" => [
            "type" => "string",
            "required" => true,
            "description" => "Tracking number",
        ],
        "carrier" => [
            "type" => "string",
            "required" => true,
            "description" => "Name of the carrier",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/tracks/{Carrier}/{TrackingNumber}";
    protected const PATH_PARAMS = [
        "TrackingNumber" => "tracking_number",
        "Carrier" => "carrier",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
