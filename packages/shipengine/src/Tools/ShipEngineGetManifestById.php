<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Manifest By Id.
 *
 * Maps to the official ShipEngine endpoint GET /v1/manifests/{manifest_id}.
 */
class ShipEngineGetManifestById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_manifest_by_id";
    protected const DESCRIPTION = "Get Manifest By Id\n\nOfficial ShipEngine endpoint: GET /v1/manifests/{manifest_id}.";
    protected const PARAMETERS = [
        "manifest_id" => [
            "type" => "string",
            "required" => true,
            "description" => "The Manifest Id",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/manifests/{manifest_id}";
    protected const PATH_PARAMS = [
        "manifest_id" => "manifest_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
