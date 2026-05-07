<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Tracking Information.
 *
 * Maps to the official ShipEngine endpoint GET /v1/tracking.
 */
class ShipEngineGetTrackingLog extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_tracking_log";
    protected const DESCRIPTION = "Get Tracking Information\n\nOfficial ShipEngine endpoint: GET /v1/tracking.";
    protected const PARAMETERS = [
        "carrier_code" => [
            "type" => "string",
            "required" => false,
            "description" => "A , such as fedex, dhl_express, stamps_com, etc.",
        ],
        "tracking_number" => [
            "type" => "string",
            "required" => false,
            "description" => "The tracking number associated with a shipment",
        ],
        "carrier_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Carrier ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/tracking";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "carrier_code" => "carrier_code",
        "tracking_number" => "tracking_number",
        "carrier_id" => "carrier_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
