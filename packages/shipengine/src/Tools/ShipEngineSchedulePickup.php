<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Schedule a Pickup.
 *
 * Maps to the official ShipEngine endpoint POST /v1/pickups.
 */
class ShipEngineSchedulePickup extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_schedule_pickup";
    protected const DESCRIPTION = "Schedule a Pickup\n\nOfficial ShipEngine endpoint: POST /v1/pickups.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Schedule a Pickup.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/pickups";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
