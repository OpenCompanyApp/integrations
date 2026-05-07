<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create a return label.
 *
 * Maps to the official ShipEngine endpoint POST /v1/labels/{label_id}/return.
 */
class ShipEngineCreateReturnLabel extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_return_label";
    protected const DESCRIPTION = "Create a return label\n\nOfficial ShipEngine endpoint: POST /v1/labels/{label_id}/return.";
    protected const PARAMETERS = [
        "label_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Label ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create a return label.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/labels/{label_id}/return";
    protected const PATH_PARAMS = [
        "label_id" => "label_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
