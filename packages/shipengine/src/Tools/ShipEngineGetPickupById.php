<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Pickup By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/pickups/{pickup_id}.
 */
class ShipEngineGetPickupById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_pickup_by_id";
    protected const DESCRIPTION = "Get Pickup By ID\n\nOfficial ShipEngine endpoint: GET /v1/pickups/{pickup_id}.";
    protected const PARAMETERS = [
        "pickup_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Pickup Resource ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/pickups/{pickup_id}";
    protected const PATH_PARAMS = [
        "pickup_id" => "pickup_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
