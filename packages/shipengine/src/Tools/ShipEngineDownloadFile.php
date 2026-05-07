<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Download File.
 *
 * Maps to the official ShipEngine endpoint GET /v1/downloads/{dir}/{subdir}/{filename}.
 */
class ShipEngineDownloadFile extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_download_file";
    protected const DESCRIPTION = "Download File\n\nOfficial ShipEngine endpoint: GET /v1/downloads/{dir}/{subdir}/{filename}.";
    protected const PARAMETERS = [
        "subdir" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `subdir`.",
        ],
        "filename" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `filename`.",
        ],
        "dir" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `dir`.",
        ],
        "download" => [
            "type" => "string",
            "required" => false,
            "description" => "query parameter `download`.",
        ],
        "rotation" => [
            "type" => "integer",
            "required" => false,
            "description" => "query parameter `rotation`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/downloads/{dir}/{subdir}/{filename}";
    protected const PATH_PARAMS = [
        "subdir" => "subdir",
        "filename" => "filename",
        "dir" => "dir",
    ];
    protected const QUERY_PARAMS = [
        "download" => "download",
        "rotation" => "rotation",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
