<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Void a Label By ID.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/labels/{label_id}/void.
 */
class ShipEngineVoidLabel extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_void_label";
    protected const DESCRIPTION = "Void a Label By ID\n\nOfficial ShipEngine endpoint: PUT /v1/labels/{label_id}/void.";
    protected const PARAMETERS = [
        "label_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Label ID",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/labels/{label_id}/void";
    protected const PATH_PARAMS = [
        "label_id" => "label_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
