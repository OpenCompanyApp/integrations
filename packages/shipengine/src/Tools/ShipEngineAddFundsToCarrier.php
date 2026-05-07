<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Add Funds To Carrier.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/carriers/{carrier_id}/add_funds.
 */
class ShipEngineAddFundsToCarrier extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_add_funds_to_carrier";
    protected const DESCRIPTION = "Add Funds To Carrier\n\nOfficial ShipEngine endpoint: PUT /v1/carriers/{carrier_id}/add_funds.";
    protected const PARAMETERS = [
        "carrier_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Carrier ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Add Funds To Carrier.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/carriers/{carrier_id}/add_funds";
    protected const PATH_PARAMS = [
        "carrier_id" => "carrier_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
