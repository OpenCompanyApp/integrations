<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Purchase Label with Rate ID.
 *
 * Maps to the official ShipEngine endpoint POST /v1/labels/rates/{rate_id}.
 */
class ShipEngineCreateLabelFromRate extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_label_from_rate";
    protected const DESCRIPTION = "Purchase Label with Rate ID\n\nOfficial ShipEngine endpoint: POST /v1/labels/rates/{rate_id}.";
    protected const PARAMETERS = [
        "rate_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Rate ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Purchase Label with Rate ID.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/labels/rates/{rate_id}";
    protected const PATH_PARAMS = [
        "rate_id" => "rate_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
