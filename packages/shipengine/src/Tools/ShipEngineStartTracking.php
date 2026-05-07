<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Start Tracking a Package.
 *
 * Maps to the official ShipEngine endpoint POST /v1/tracking/start.
 */
class ShipEngineStartTracking extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_start_tracking";
    protected const DESCRIPTION = "Start Tracking a Package\n\nOfficial ShipEngine endpoint: POST /v1/tracking/start.";
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
    protected const METHOD = "POST";
    protected const PATH = "/v1/tracking/start";
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
