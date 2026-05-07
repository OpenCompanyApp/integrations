<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Label By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/labels/{label_id}.
 */
class ShipEngineGetLabelById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_label_by_id";
    protected const DESCRIPTION = "Get Label By ID\n\nOfficial ShipEngine endpoint: GET /v1/labels/{label_id}.";
    protected const PARAMETERS = [
        "label_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Label ID",
        ],
        "label_download_type" => [
            "type" => "string",
            "enum" => [
                "url",
                "inline",
            ],
            "required" => false,
            "description" => "There are two different ways to : Label Download Type Description -------------------------------------------------- url You will receive a URL, which you can use to download the label in a separate request. The URL will remain valid for 90 days. inline You will receive the Base64-encoded label as part of the response. No need for a second request to download the label.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/labels/{label_id}";
    protected const PATH_PARAMS = [
        "label_id" => "label_id",
    ];
    protected const QUERY_PARAMS = [
        "label_download_type" => "label_download_type",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
