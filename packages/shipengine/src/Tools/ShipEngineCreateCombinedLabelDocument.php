<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Created Combined Label Document.
 *
 * Maps to the official ShipEngine endpoint POST /v1/documents/combined_labels.
 */
class ShipEngineCreateCombinedLabelDocument extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_combined_label_document";
    protected const DESCRIPTION = "Created Combined Label Document\n\nOfficial ShipEngine endpoint: POST /v1/documents/combined_labels.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Created Combined Label Document.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/documents/combined_labels";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
