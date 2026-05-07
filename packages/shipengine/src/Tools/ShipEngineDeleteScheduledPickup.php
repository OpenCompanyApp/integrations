<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Delete a Scheduled Pickup.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/pickups/{pickup_id}.
 */
class ShipEngineDeleteScheduledPickup extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_delete_scheduled_pickup";
    protected const DESCRIPTION = "Delete a Scheduled Pickup\n\nOfficial ShipEngine endpoint: DELETE /v1/pickups/{pickup_id}.";
    protected const PARAMETERS = [
        "pickup_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Pickup Resource ID",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/pickups/{pickup_id}";
    protected const PATH_PARAMS = [
        "pickup_id" => "pickup_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
