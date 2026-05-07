<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update Shipments Tags.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/shipments/tags.
 */
class ShipEngineShipmentsUpdateTags extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_shipments_update_tags";
    protected const DESCRIPTION = "Update Shipments Tags\n\nOfficial ShipEngine endpoint: PUT /v1/shipments/tags.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Update Shipments Tags.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/shipments/tags";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
